<?php

/**
 * Outputs a web page 'header'.
 * 
 * Outputs the preamble, the head (including title and link to stylesheet), the body start
 * tag, and an h1 (the same as the title).
 * @param $title the page title and also the page's main h1 heading
 * @param $stylesheet the URL of the page's CSS stylesheet
 */
function output_header( $title, $stylesheet )
{
    echo 
        '<?xml version="1.0" encoding="UTF-8"?>
         <!DOCTYPE html 
          PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
          "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
         <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
         <head>';
    echo "<title>{$title}</title>";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$stylesheet}\" />";
	echo "<link rel=\"shortcut icon\" href=\"favicon.ico\" />";
    echo 
        '</head>
         <body>';
    echo "<h1>{$title}</h1>";
}

/**
 * Outputs a web page 'footer'.
 * 
 * Outputs a div containing a copyright notice, the body end tag, and the html end tag.
 * @param $organization the copyright owner
 */
function output_footer( $organization )
{
    echo '<div id="footer">';
    echo '&copy; ' . date('Y') . ' ' . $organization;
    echo
        '</div>
         </body>
         </html>';      
}

/**
 * Outputs an XHTML paragraph element.
 * 
 * @param $text the element's textual content
 */
function output_paragraph( $text )
{
    echo "<p>{$text}</p>";
}

/**
 * Outputs a submit button for an XHTML form.
 * 
 * @param $button_label the text to appear on the button
 */ 
function output_submit_button( $button_label ) 
{
    echo "<input type=\"submit\" name=\"submit\" value=\"{$button_label}\" />";
}

/**
 * Outputs a reset button for an XHTML form.
 * 
 * @param $button_label the text to appear on the button
 */
function output_reset_button( $button_label ) 
{
    echo "<input type=\"reset\" name=\"reset\" value=\"{$button_label}\" />";
}

/**
 * Outputs a text field for an XHTML form.
 * 
 * Outputs a text field for an XHTML form, with an accompanying label, all wapped in a div.
 * @param $id the value of the XHTML id attribute
 * @param $label the content of the XHTML label element
 * @param $name the value of the XHTML name attribute
 * @param $size the value of the XHTML size attribute
 * @param $maxlength the value of the XHTML maxlength attribute
 * @param $value the value of the XHTML value attribute
 * @param $is_disabled a Boolean: if true, this text field is disabled (disabled="disabled"); if false, the user can enter data into it
 */
function output_textfield( $id, $label, $name, $size, 
                    $maxlength, $value, $is_disabled ) 
{
    echo "<div>";
    echo "<label for=\"{$id}\">{$label}</label>";
    echo "<input type=\"text\" id=\"{$id}\" name=\"{$name}\" 
        size=\"{$size}\" maxlength=\"{$maxlength}\" value=\"{$value}\" ";
    echo $is_disabled ? "disabled=\"disabled\" " : "";
    echo "/>";
    echo "</div>";
}

/**
 * Outputs a password field for an XHTML form.
 * 
 * Outputs a password field for an XHTML form, with an accompanying label, all wapped in a div.
 * @param $id the value of the XHTML id attribute
 * @param $label the content of the XHTML label element
 * @param $name the value of the XHTML name attribute
 * @param $size the value of the XHTML size attribute
 * @param $maxlength the value of the XHTML maxlength attribute
 * @param $value the value of the XHTML value attribute
 */
function output_passwordfield( $id, $label, $name, $size, 
                    $maxlength, $value ) 
{
    echo "<div>";
    echo "<label for=\"$id\">{$label}</label>";
    echo "<input type=\"password\" id=\"{$id}\" name=\"{$name}\" 
        size=\"{$size}\" maxlength=\"{$maxlength}\" value=\"{$value}\" />";
    echo "</div>";
}

/**
 * Outputs an XHTML unordered list (ul) element from an array.
 * 
 * @param $items the array of items that will form the list's items (li)
 */ 
function output_unordered_list( &$items )
{
    echo "<ul>";
    foreach ($items as $item)
    {
        echo "<li>{$item}</li>";
    }
    echo "</ul>";
}

/**
 * Outputs an XHTML ordered list (ol) element from an array.
 * 
 * @param $items the array of items that will form the list's items (li)
 */ 
function output_ordered_list( &$items )
{
    echo "<ol>";
    foreach ($items as $item)
    {
        echo "<li>{$item}</li>";
    }
    echo "</ol>";
}
?>
