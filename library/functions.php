<?php
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

//  Check the password for a minimum of 8 charactersl
//  at least 1 capital letter, at least 1 number and 
//  at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function buildNav(){
    // Get the array of classifications, from the main-model.php file
    $classifications = getClassifications();
    // TEST LINES V
    // var_dump($classifications);
    // 	exit;

    // Build a navigation bar using the $classifications array
    $navList = '<ul>';
    // $navList .= '<button onclick="toggleMenu()">&#9776;</button>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page' class='horizontal-padding'>Home</a></li>";

    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line' class='horizontal-padding'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    
    // Test for the information brough from the server
    // echo $navList;
    // exit;

    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
}
//  VEHICLE ALONE, Info
//  --------------------
function buildVehicleInfo($vehicle){
    $cost = '$' . number_format($vehicle['invPrice'], 2);
    $vp = "<div id='vehicle-wrapper' class='space'>";
    $vp .= "<div id='vehicle-img'><img src=$vehicle[invImage] class='vehicle-img' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></div>";
    $vp .= "<div id='info-wrapper'>";
    $vp .= "<div id='vehicle-paragraph'><p class='grey padding'>$vehicle[invDescription]</p>";
    $vp .= "<p class='light-grey padding'><b>Color:</b> $vehicle[invColor]</p>";
    $vp .= "<p class='grey padding'><b>Num. in stock:</b> $vehicle[invStock]</p>";
    $vp .= "<p class='light-grey padding'><b>Price:</b> $cost</p></div></div></div>";



    return $vp;
}

/* * ********************************
*  Functions for working with images
* ********************************* */
// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul class="image-display">';
    foreach ($imageArray as $image) {
        $id .= "<li class='vehicle-img-wrapper'>";
        $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com' class='img-mini'>";
        $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image' class='delete-text'>DELETE- $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}

// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($image_dir_path, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // Returns the path where the file is stored
        return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
} // ends resizeImage function

function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display" class="space2">';
    foreach ($vehicles as $vehicle) {
        $cost = '$' . number_format($vehicle['invPrice'], 2);
        $dv .= '<li class="space">';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicleInfo&invId=$vehicle[invId]&classificationId=$vehicle[classificationId]' class='no-decoration black-txt'>";
        $dv .= "<img class='vehicle-img' src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<div class='center'><h4>$vehicle[invMake] $vehicle[invModel]</h4>";
        $dv .= "<span class='bottom-margin'>$cost</span></a></div>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

//  Create the Thumbnails Display
function buildThumbnailsDisplay($thumbnailsPath){
    
    $td = "<h4 class='thumbnail-title'>Thumbnail Images</h4>";
    $td .= "<div class='thumbnails-wrapper'>";
    foreach ($thumbnailsPath as $thumbnail){
        $td .= "<div class='thumbnail-img-wrapper'><img src='$thumbnail[imgPath]' alt='Extra vehicle image' class='thumbnail-image'></div>";
        // $td .= "<div class='thumbnail-img-wrapper'>$thumbnail[imgPath]</div>";
    }
    $td .= "</div>";
    return $td;
}


//  Creates the search results Display
function buildSearchDisplay($searchResults, $totalResults, $currentPage){    
        
    $totalPages = ceil($totalResults/10);
    //  Adds the text for the number of results found. Adds s for plural if more than 1.
        $sd = "<h2>Found $totalResults result";
        if($totalResults > 1){
            $sd .= "s";
        }
        $sd .= " for: '$_SESSION[searchQuery]'</h2>";

    //  Creates each resuls capsule iterating depending on the page received
    foreach($searchResults as $vehicle){
        $sd .= "<div class='search-item'>";
        $sd .= "<a href='/phpmotors/vehicles/?action=vehicleInfo&invId=";
        $sd .= $vehicle['invId'];
        $sd .= "&classificationId=";
        $sd .= $vehicle['classificationId'];
        $sd .= "'><h2>";
        $sd .= $vehicle['invMake'] . " " . $vehicle['invModel'];
        $sd .= "</h2></a>";
        $sd .= "<p>";
        $sd .= $vehicle['invDescription'];
        $sd .= "</p></div>";
    }
    $sd .= "<div class='horizontal'>";

    if($currentPage > 1){
        $sd .= "<a href='/phpmotors/vehicles/?action=switch-page&currentPage=";
        $sd .= $currentPage - 1;
        $sd .= "&totalResults=$totalResults'> <<< </a>";
    }
    for($page = 1; $page <= $totalPages ; $page++){
        if($page != $currentPage){
            $sd .= "<a href='/phpmotors/vehicles/?action=switch-page&currentPage=$page&totalResults=$totalResults'> $page </a>";
        }else{
            $sd .= "<p> $page </p>";
        }
    }
    if($currentPage < $totalPages){
        $sd .= "<a href='/phpmotors/vehicles/?action=switch-page&currentPage=";
        $sd .= $currentPage + 1;
        $sd .= "&totalResults=$totalResults'> >>> </a>";
    }
    
    $sd .= "</div>";

    return $sd;
}
?>