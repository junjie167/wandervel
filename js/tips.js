/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery( "li:has(ul)" ).click(function(){ // When a li that has a ul is clicked ...
	jQuery(this).toggleClass('active'); // then toggle (add/remove) the class 'active' on it. 
});
