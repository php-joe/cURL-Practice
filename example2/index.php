<?php
//use simple class to encapsulate date
class Download {

  const URL_MAX_LENGTH = 2040;

  //create method in class to clean url
  protected function cleanUrl($url) {
    if (isset($url)) {
      if (!empty($url)) {
        if (strlen($url) < self::URL_MAX_LENGTH)
          return strip_tags($url);
      }
    }
  }

//verify it is a actual url
protected function isUrl($url) {
    $url = $this->cleanUrl($url);
    if (isset($url)){
      if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) {
        return $url;
      }
    }
}

//get or return extension if it is an actual url
protected function returnExtension($url) {
  if ($this->isUrl($url)) {
    $end = end(preg_split("/[.]/", $url));
    if (isset($end)){
      return $end;
    }
  }
}

//download file
public function downloadFile($url) {
  if ($this->isUrl($url)) {
    $extension = $this->returnExtension($url);
    if ($extension) {
      /* tested firstecho $url; */

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);

      //since we don't want it returned in the value we set to true, (false would return it into browser as encoded text)
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $return = curl_exec($ch);
      curl_close($ch);

      //create path to our downloads folder
      $destination = "downloads/file.$extension";

      //let's open folder and set to read a write
      $file = fopen($destination, "w+");
      fputs($file, $return);
      //close file fclose is a boolean
      if (fclose($file)) {
        echo "file downloaded";
      }
    }
  }

}
}


$obj = new Download();
if (isset($_POST['url'])) {$url = $_POST['url']; }

?>

<form action="http://localhost/cURL/example2/index.php" method="post">
  <input type="text" name="url" maxlength="2000" />
  <input type="submit" value="Download" />

<form>

<?php
if (isset($url)) { $obj->downloadFile($url); }
 ?>
