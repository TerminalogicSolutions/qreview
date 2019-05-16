<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.iv_gallery_fieldset fieldset{
border:none;
}
 
.iv_image{
width:20em;
border:1px solid #ccc;
margin:0 10px 10px 0;
float:left;
}
 
.ivg_inner{
padding:1em;
}
 
.iv_image_thumb{
height:150px;
margin:1em auto;
clear:both;
text-align:center;
}
 
.iv_image_thumb img{
height:144px;
}
 
.ui-draggable-dragging .iv_image_thumb img{
width:400px;
height:auto;
margin:-100px 0 0 -100px;
position:relative;
z-index:998;
}
 
.ivg_toolbar{
cursor:move;
background:#006;
border-bottom:1px solid #ccc;
text-align:right;
}
 
.ivg_toolbar span{
border-left:1px solid #888;
font-weight:bold;
background:#d00;
color:#fff;
padding:0 4px;
cursor:pointer;
}
 
.droppable-hover{
border:2px solid #0f0;
opacity:.5;
margin:0 8px 8px 0;
}
 
.droppable-hover input,
.droppable-hover textarea,
.droppable-hover label{
visibility:hidden;
}
 
.ui-draggable-dragging input,
.ui-draggable-dragging textarea,
.ui-draggable-dragging label{
display:none;
}
 
.ui-draggable-dragging{
border:0;
}
-->
</style>
<script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript">
function Drag_n_Drop()
    {
        return '<script type="text/javascript">
jQuery(document).ready(function(){
 
    /**
     * Add our toolbar
     */
    jQuery( ".ivg_dragndrop").prepend("<div class=\"ivg_toolbar\"><span class=\"ivg_close\" onclick=\"jQuery(this).parent().parent().remove();ivgRecalc();\">X</span></div>" );
 
    
    /**
     * Make images draggable
     */
    jQuery(".ivg_dragndrop").draggable({
            helper: "clone", // use a copy of the image
            scroll: true, // scroll the window during dragging
            scrollSensitivity: 100, // distance from edge before scoll occurs
            zIndex: 999, // zindex whilst dragging
            opacity: .5, // opacity whilst dragging
            distance: 10, // min distance to move mouse before drag starts
            handle: ".ivg_toolbar",    // makes toolbar the dragable part
            stop:function(ev, ui) { // called on drop action
                window.setTimeout( "ivgRecalc()", 100 ); // add a delay whilst the objects are replaced
            },
    });
 
 
    /**
     * Action to take after dropping image on target
     */
    jQuery(".ivg_dragndrop").droppable({
        accept: ".ivg_dragndrop", // classname of objects that can be dropped
        hoverClass: "droppable-hover", // classname when object is over this one
        drop: function(ev, ui) {    // function called when object dropped
                jQuery(ui.draggable).insertBefore( this ); // insert the dragged image before this image
            }
        });
    });
 
    
    /**
     * Re-calculates the image order after drop
     */
    function ivgRecalc()
    {
        jQuery( ".iv_image_order" ).attr( "value", function( pos ){
                    return pos;
        });
}

'."\n";
        }
</script>		
</head>
<body>
<div class="iv_image ivg_dragndrop" id="ivg_image_0">
<div class="ivg_inner">
<label for="image_title_0">Title:</label><input maxlength="30" size="30" type="text" class="form_text_input" name="image_title_0" id="image_title_0" />
<input type="hidden" name="iv_image_order_0" value="1" class="iv_image_order" />
<div class="iv_image_thumb"><img src="http://innervisions.org.uk/getdetail/?c7cc15b26ace4690151aa3d32fe6bc15bimble/june2008/planting/detail/image9.jpg" /></div>
<label for="image_description_0">Description:</label><textarea cols="30" class="form_textarea_input" name="image_description_0" id="image_description_0" rows="5"></textarea>
</div>
</div>
</body>
</html>