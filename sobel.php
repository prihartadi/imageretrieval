<?php 

function sobel($source_image){
    // a butterfly image picked on flickr
    // $source_image = "C:/Users/prihartadi/Desktop/test.jpg";

    // creating the image
    $starting_img = imagecreatefrompng($source_image);

    // getting image information (I need only width and height)
    $im_data = getimagesize($source_image);

    // this will be the final image, same width and height of the original
    $final = imagecreatetruecolor($im_data[0],$im_data[1]);

    // looping through ALL pixels!!
    for($x=1;$x<($im_data[0]-1);$x++){
        for($y=1;($y<$im_data[1]-1);$y++){
            // getting gray value of all surrounding pixels
            $pixel_up = get_luminance(imagecolorat($starting_img,$x,$y-1));
            $pixel_down = get_luminance(imagecolorat($starting_img,$x,$y+1)); 
            $pixel_left = get_luminance(imagecolorat($starting_img,$x-1,$y));
            $pixel_right = get_luminance(imagecolorat($starting_img,$x+1,$y));
            $pixel_up_left = get_luminance(imagecolorat($starting_img,$x-1,$y-1));
            $pixel_up_right = get_luminance(imagecolorat($starting_img,$x+1,$y-1));
            $pixel_down_left = get_luminance(imagecolorat($starting_img,$x-1,$y+1));
            $pixel_down_right = get_luminance(imagecolorat($starting_img,$x+1,$y+1));
            
            // appliying convolution mask
            $conv_x = ($pixel_up_right+($pixel_right*2)+$pixel_down_right)-($pixel_up_left+($pixel_left*2)+$pixel_down_left);
            $conv_y = ($pixel_up_left+($pixel_up*2)+$pixel_up_right)-($pixel_down_left+($pixel_down*2)+$pixel_down_right);
            
            // calculating the distance
            $gray = sqrt($conv_x*$conv_x+$conv_y+$conv_y);
            //$gray = abs($conv_x)+abs($conv_y);
            
            // inverting the distance not to get the negative image                
            $gray = 255-$gray;
            
            // adjusting distance if it's greater than 255 or less than zero (out of color range)
            if($gray > 255){
                $gray = 255;
            }
            if($gray < 0){
                $gray = 0;
            }
            
            // creation of the new gray
            $new_gray  = imagecolorallocate($final,$gray,$gray,$gray);
            
            // adding the gray pixel to the new image        
            imagesetpixel($final,$x,$y,$new_gray);            
        }
    }

    // telling the browser we are going to output a jpeg image
    //header('Content-Type: image/jpeg');

    // creation of the final image
    //imagepng($final);

    // freeing memory
    //imagedestroy($starting_img);
    //imagedestroy($final);

    return $final;
}

// function to get the luminance value
function get_luminance($pixel){
    $pixel = sprintf('%06x',$pixel);
    $red = hexdec(substr($pixel,0,2))*0.30;
    $green = hexdec(substr($pixel,2,2))*0.59;
    $blue = hexdec(substr($pixel,4))*0.11;
    return $red+$green+$blue;
}

?>