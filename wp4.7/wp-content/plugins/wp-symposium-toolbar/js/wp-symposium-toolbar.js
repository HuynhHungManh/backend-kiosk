/*  Copyright 2013-2015 Guillaume Assire aka AlphaGolf (alphagolf@rocketmail.com)
 *	
 *	This program is free software; you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License, version 2, as 
 *	published by the Free Software Foundation.
 *	
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *	
 *	You should have received a copy of the GNU General Public License
 *	along with this program; if not, write to the Free Software
 *	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

jQuery(document).ready(function($){

	// SAFERS
	
	window.onbeforeunload = confirmExit;
	function confirmExit() {
		if ( needToConfirm )
			return wpstL10n.needToConfirm;
	}
	
	
	// TABS MANAGER
	
	var isRTL = !! ( 'undefined' != typeof isRtl && isRtl );		// Right-to-left stuff
	var navWidth = 0;												// Container width, will be set dynamically, from #wpst-nav-management width
	var tabsWidth = 0;												// Tabs tape width, will be set at page load, back to #wpst-nav-tabs width
	var activeLeft = 0, activeRight = 0;							// Positions of the edges of the active tab, in the tabs tape, right divider included
	var tabsShift = 0;												// Shift of tabs tape in container, #wpst-nav-tabs margin-left (or margin-right if RTL)
	var delta = 0;													// Increment used to shift the tabs upon click on arrows, will be set dynamically
	var ratio = 5;													// Increment for the scroll of the tabs tape - a value of 5 means 1/5th of the screen
	var arrowWidth = $( '#wpst-nav-tabs-arrow-left' ).outerWidth();	// The width of an arrow container
	var tabsRight = 0;												// The gap for the arrows, if shown, at the right of the tabs
	var tabs = $( '#wpst-nav-tabs' ).find( '.wpst-nav-tab' );		// The list of all the tabs
	
	// RTL stuff...
	if ( isRTL ) {
		$( '#wpst-nav-tabs-arrow-left' ).find( "a" ).text( ">" );
		$( '#wpst-nav-tabs-arrow-right' ).find( "a" ).text( "<" );
	}
	
	// Update tabs upon page load and any further page resize
	update_tabs();
	$( window ).resize(function() {
		update_tabs();
	});
	
	// Enabler for the above
	function update_tabs() {
		
		// Get the current screen width
		navWidth = $( '#wpst-nav-management' ).width();
		
		// Recompute the left/right arrows width in case of switch between responsive and normal
		arrowWidth = $( '#wpst-nav-tabs-arrow-left' ).outerWidth();
		
		// Compute the cumulated width of all tabs and set the container width accordingly
		tabs.last().css( "margin-right", "0px" );
		tabsWidth = 0;
		tabs.each( function(){
			tabsWidth += $( this ).outerWidth( true );
			if ( $( this ).hasClass( 'wpst-nav-tab-active' ) ) {
				activeRight = tabsWidth;
				activeLeft = activeRight - $( this ).outerWidth( true );
			}
		});
		$( '#wpst-nav-tabs' ).width( tabsWidth + ( arrowWidth * 2 ) );
		
		// Tabs are too large for the container, add arrows
		if ( tabsWidth > navWidth ) {
			$( "#wpst-nav-tabs-wrapper" ).css( "padding", "0px " + arrowWidth + "px" );
			$( "#wpst-nav-management" ).find( ".wpst-nav-tabs-arrow" ).css( "display", "inline" );
			tabsRight = ( arrowWidth * 2);
			if ( tabsShift > ( navWidth - activeRight - tabsRight ) ) tabsShift = navWidth - activeRight - tabsRight;
			if ( ( activeLeft + tabsShift ) <= 0 ) tabsShift = -1 * activeLeft;
			
			if ( isRTL ) $( '#wpst-nav-tabs' ).css( "margin-right", ( tabsShift ) + "px" );
			else $( '#wpst-nav-tabs' ).css( "margin-left", ( tabsShift ) + "px" );
		
		// Tabs are smaller than container or became smaller, hide / remove arrows
		} else {
			$( "#wpst-nav-tabs-wrapper" ).css( "padding", "0px" );
			$( "#wpst-nav-management" ).find( ".wpst-nav-tabs-arrow" ).css( "display", "none" );
			tabsRight = 0;
			tabsShift = 0;
			
			if ( isRTL ) $( '#wpst-nav-tabs' ).css("margin-right", "0px");
			else $( '#wpst-nav-tabs' ).css("margin-left", "0px");
		}
		
		$( '#wpst-nav-tabs-wrapper' ).outerWidth( navWidth );
		delta = Math.floor( navWidth / ratio );
	}
	
	// Scroll the tabs upon clicking on arrows
	$(".wpst-nav-tabs-arrow").click(function() {
		
		if ( ( !isRTL && ( this.id == 'wpst-nav-tabs-arrow-left' ) ) || ( isRTL && ( this.id == 'wpst-nav-tabs-arrow-right' ) ) ) {
			tabsShift = tabsShift + delta;
			if ( tabsShift > 0 ) tabsShift = 0;
		} else {
			tabsShift = tabsShift - delta;
			if ( tabsShift < ( navWidth - tabsWidth - tabsRight) ) tabsShift = navWidth - tabsWidth - tabsRight;
		}
		
		if ( isRTL )
			$( '#wpst-nav-tabs' ).animate({marginRight: tabsShift},"fast","swing");
		else
			$( '#wpst-nav-tabs' ).animate({marginLeft: tabsShift},"fast","swing");
	});
	
	
	// STYLE TAB BOXES
	
	// Close all boxes by default
	$(".wpst-style-widefat").hide();
	
	// When a Style h3 is clicked, open / close the box underneath
	$(".wpst-hndle").click(function() {
		
		var item = document.getElementById( this.id+'_inside' );
		
		if ( item.style.display !== 'none' ) {
			item.style.display = 'none';
		} else {
			item.style.display = 'table';
		}
	});
	
	
	// ADMIN CHECKERS
	
	// Data was edited, user needs to confirm when leaving page
	$(".wpst-admin").change(function() {
		
		needToConfirm = true;
	});
	
	// Data was saved
	$(".wpst-save").click(function() {
		
		needToConfirm = false;
	});
	
	// Toggle checkboxes ticks to all/none
	$(".wpst-all-none").click(function() {
		
		var items = document.getElementById( this.id+'_row' ).getElementsByTagName( 'input' );
		var checked = items[0].checked;
		
		for( var i in items ) items[i].checked = !checked;
		for( var i in items ) {
			if ( items[i].style !== undefined ) items[i].style.outline = 'none';
		}
		
		needToConfirm = true;
	});
	
	// Erase the error outline around a checkbox when it is clicked
	$("input.wpst-error").click(function() {
		
		$(this).removeClass( "wpst-error" );
	});
	
	// Erase the error outline for multiple checkboxes when one is clicked
	$(".wpst-checkboxes").click(function() {
		
		var items = document.getElementById( this.id ).getElementsByTagName( 'input' );
		
		for( var i in items ) {
			$( items[i] ).removeClass( "wpst-error" );
		}
	});
	
	// Erase the error outline around a select when it is changed
	$("select.wpst-error").change(function() {
		
		$(this).removeClass( "wpst-error" );
	});
	
	// Erase the error outline around the input#rewrite_edit_link
	$("#rewrite_edit_link.wpst-error").keydown(function() {
		
		this.style.outline = 'none';
	});
	
	// Put the error outline back around the input#rewrite_edit_link in case field is still incorrect
	$("#rewrite_edit_link.wpst-no-wps").blur(function() {
		
		if ( $(this).val() == '%symposium_profile%' ) { this.style.outline = '1px solid #CC0000'; }
	});
	
	// In such fields, User shall input an integer
	$(".wpst-int").keyup(function() {
	
		if ( ( $(this).val() != "" ) && ( $(this).val() != "-" ) && ( parseInt($(this).val()) != $(this).val() ) ) {
			$(this).css("background-color", "#ffebe8");
			$(this).css("border", "1px solid #cc0000");
		} else {
			$(this).css("background-color", "#ffffff");
			$(this).css("border", "1px solid #dfdfdf");
		}
	});
	
	// In such fields, User shall input a positive integer
	$(".wpst-positive-int").keyup(function() {
	
		if ( ( $(this).val() != "" ) && ( ( parseInt($(this).val()) < 0 ) || ( parseInt($(this).val()) != $(this).val() ) ) ) {
			$(this).css("background-color", "#FFEBE8");
			$(this).css("border", "1px solid #CC0000");
		} else {
			$(this).css("background-color", "#ffffff");
			$(this).css("border", "1px solid #dfdfdf");
		}
	});
	
	// In such fields, User shall input a positive integer, lower than 782
	$(".wpst-responsive-int").keyup(function() {
	
		if ( ( $(this).val() != "" ) && ( ( ( parseInt($(this).val()) < 0 ) ||( parseInt($(this).val()) > 782 ) ) || ( parseInt($(this).val()) != $(this).val() ) ) ) {
			$(this).css("background-color", "#FFEBE8");
			$(this).css("border", "1px solid #CC0000");
		} else {
			$(this).css("background-color", "#ffffff");
			$(this).css("border", "1px solid #dfdfdf");
		}
	});
	
	// In such fields, User shall input a percentage, positive integer from 0 to 100
	$(".wpst-percent").keyup(function() {
	
		if ( ( $(this).val() != "" ) && ( ( parseInt($(this).val()) < 0 ) || ( parseInt($(this).val()) > 100 ) || ( parseInt($(this).val()) != $(this).val() ) ) ) {
			$(this).css("background-color", "#FFEBE8");
			$(this).css("border", "1px solid #CC0000");
		} else {
			$(this).css("background-color", "#ffffff");
			$(this).css("border", "1px solid #dfdfdf");
		}
	});
	
	// These fields may contain a greyed out default value
	// Upon focus, remove default value and turn color darker
	$(".wpst-default").focus(function() {
		
		if ( $(this).val() == document.getElementById( this.id+"_default" ).value ) {
			this.value = "";
			$(this).removeClass( "wpst-has-default" );
		}
	});
	
	// These fields contain a greyed out default value
	// Upon blurred, if empty, re-add default value and turn color into light grey
	$(".wpst-default").blur(function() {
		
		// If this is empty, fill it with default value
		if ( $(this).val() == "" ) {
			this.value = document.getElementById( this.id+"_default" ).value;
		}
		
		// If this contains a default value, add default class
		if ( $(this).val() == document.getElementById( this.id+"_default" ).value ) {
			$(this).addClass( "wpst-has-default" );
		}
	});
});
