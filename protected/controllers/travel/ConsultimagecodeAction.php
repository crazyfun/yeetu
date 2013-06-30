<?php
class ConsultimagecodeAction extends BaseAction{
    protected function beforeAction(){
        
        return true;
    }
    protected function do_action(){
       $line_colors = preg_split("/,\s*?/", CV::CODE_LINE_COLORS);
			 $char_colors = preg_split("/,\s*?/", CV::CODE_CHAR_COLORS);
			 
			 $fonts = $this->collect_files(CV::PATH_TTF, "ttf");
       $img = imagecreatetruecolor(CV::CODE_WIDTH, CV::CODE_HEIGHT);
       imagefilledrectangle($img, 0, 0, CV::CODE_WIDTH - 1, CV::CODE_HEIGHT - 1, $this->gd_color(CV::CODE_BG_COLOR));

       //$fonts = imageloadfont($fonts);
       // Draw lines
      for ($i = 0; $i < CV::CODE_LINES_COUNT; $i++)
        imageline($img,
          rand(0, CV::CODE_WIDTH - 1),
          rand(0, CV::CODE_HEIGHT - 1),
          rand(0, CV::CODE_WIDTH - 1),
          rand(0, CV::CODE_HEIGHT - 1),
          $this->gd_color($line_colors[rand(0, count($line_colors) - 1)])
       );
// Draw code
     $code = "";
     $y = (CV::CODE_HEIGHT / 2) + (CV::CODE_FONT_SIZE / 2);
     for ($i = 0; $i < CV::CODE_CHARS_COUNT; $i++) {
      $color = $this->gd_color($char_colors[rand(0, count($char_colors) - 1)]);
      $angle = rand(-30, 30);
      $char = substr(CV::CODE_ALLOWED_CHARS, rand(0, strlen(CV::CODE_ALLOWED_CHARS) - 1), 1);
      $font = CV::PATH_TTF . "/" . $fonts[rand(0, count($fonts) - 1)];
      $x = (intval((CV::CODE_WIDTH / CV::CODE_CHARS_COUNT) * $i) + (CV::CODE_FONT_SIZE / 2));
      $code .= $char;
      imagettftext($img, CV::CODE_FONT_SIZE, $angle, $x, $y, $color, $font, $char);
     }
 
    Yii::app()->session->add('consult__img_code__',md5($code));
    header("Content-Type: image/png");
    imagepng($img);
    imagedestroy($img);
  
  }
  
  
function gd_color($html_color) {
    return preg_match('/^#?([\dA-F]{6})$/i', $html_color, $rgb)
      ? hexdec($rgb[1]) : false;
}


function collect_files($dir, $ext) {
    if (false !== ($dir = opendir($dir))) {
        $files = array();

        while (false !== ($file = readdir($dir)))
            if (preg_match("/\\.$ext\$/i", $file))
                $files[] = $file;
        return $files;

    } else
        return false;
}
}
?>
