<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * CCaptcha class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CCaptcha renders a CAPTCHA image element.
 *
 * The image element rendered by CCaptcha will display a CAPTCHA image generated
 * by an action of class {@link CCaptchaAction} belonging to the current controller.
 * By default, the action ID should be 'captcha', which can be changed by setting {@link captchaAction}.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id$
 * @package system.web.widgets.captcha
 * @since 1.0
 */
class Captcha extends CI_Controller {
	
	/**
	* @desc 認證碼 SESSION NAME
	* @author Bill Yeh
	* @created 2012/09/20
	*/
	public $session_name = "captcha";
	
	/**
	 * The name of the GET parameter indicating whether the CAPTCHA image should be regenerated.
	 */
	const REFRESH_GET_VAR='refresh';
	/**
	 * @var integer the width of the generated CAPTCHA image. Defaults to 120.
	 */
	public $width = 120;
	/**
	 * @var integer the height of the generated CAPTCHA image. Defaults to 50.
	 */
	public $height = 50;
	/**
	 * @var integer padding around the text. Defaults to 2.
	 */
	public $padding = 2;
	/**
	 * @var integer the background color. For example, 0x55FF00.
	 * Defaults to 0xFFFFFF, meaning white color.
	 */
	public $backColor = 0xFFFFFF;
	/**
	 * @var integer the font color. For example, 0x55FF00. Defaults to 0x2040A0 (blue color).
	 */
	public $foreColor = 0x2040A0;
	/**
	 * @var boolean whether to use transparent background. Defaults to false.
	 */
	public $transparent = false;
	/**
	 * @var integer the minimum length for randomly generated word. Defaults to 6.
	 */
	public $minLength = 6;
	/**
	 * @var integer the maximum length for randomly generated word. Defaults to 7.
	 */
	public $maxLength = 7;
	/**
	 * @var integer the offset between characters. Defaults to -2. You can adjust this property
	 * in order to decrease or increase the readability of the captcha.
	 * @since 1.1.7
	 **/
	public $offset = -2;
	/**
	 * @var string the TrueType font file. Defaults to Duality.ttf which is provided
	 * with the Yii release.
	 */
	public $fontFile;
	
	function __construct() {
		if (!isset($_SESSION)) session_start(); // 開啟 session
		parent::__construct();
	}	

	/**
	 * 立即產生認證碼圖片
	 */
	function index() {
		if ($this->checkRequirements()) {
			if (isset($_GET[self::REFRESH_GET_VAR])) { // 如果網址後面有 refresh , 驗證碼不變
				$this->renderImage($this->getVerifyCode(true)); // 產生認證碼圖片
			} else {
				$this->renderImage($this->getVerifyCode()); // 產生認證碼圖片
			}
		} else {
			$msg = 'GD and FreeType PHP extensions are required.';
			echo "<b>Error: </b>$msg";
			exit;
		}
	}
	
	/**
	* @desc 抓取目前認證碼
	* @author Bill Yeh
	* @created 2012/09/20
	*/
	function sGetAuthCode() {
		return $_SESSION[$this->session_name];
	}

	/**
	 * Checks if GD with FreeType support is loaded.
	 * @return boolean true if GD with FreeType support is loaded, otherwise false
	 * @since 1.1.5
	 */
	function checkRequirements() { // 檢查套件是否安裝
		if (extension_loaded('gd')) {
			$gdinfo=gd_info();
			if($gdinfo['FreeType Support'])
				return true;
		}
		return false;
	}	

	/**
	 * Gets the verification code.
	 * @param boolean $regenerate whether the verification code should be regenerated.
	 * @return string the verification code.
	 */
	function getVerifyCode($regenerate=false) { // 產生認證碼字串
		$name = "captcha";
		if ($regenerate) {
			return $_SESSION[$this->session_name];
		}
		$_SESSION[$this->session_name] = $this->generateVerifyCode();
		$_SESSION[$this->session_name . 'count'] = 1;
		return $_SESSION[$this->session_name];
	}

	/**
	 * Generates a new verification code.
	 * @return string the generated verification code
	 */
	function generateVerifyCode() {
		if($this->minLength < 3) $this->minLength = 3;
		if($this->maxLength > 20) $this->maxLength = 20;
		if($this->minLength > $this->maxLength)
			$this->maxLength = $this->minLength;
		$length = mt_rand($this->minLength,$this->maxLength);

		$letters = 'bcdfghjklmnpqrstvwxyz';
		$vowels = 'aeiou';
		$code = '';
		for($i = 0; $i < $length; ++$i) {
			if($i % 2 && mt_rand(0,10) > 2 || !($i % 2) && mt_rand(0,10) > 9)
				$code.=$vowels[mt_rand(0,4)];
			else
				$code.=$letters[mt_rand(0,20)];
		}

		return $code;
	}

	/**
	 * Renders the CAPTCHA image based on the code.
	 * @param string $code the verification code
	 * @return string image content
	 */
	function renderImage($code) {
		$image = imagecreatetruecolor($this->width,$this->height);

		$backColor = imagecolorallocate($image,
				(int)($this->backColor % 0x1000000 / 0x10000),
				(int)($this->backColor % 0x10000 / 0x100),
				$this->backColor % 0x100);
		imagefilledrectangle($image,0,0,$this->width,$this->height,$backColor);
		imagecolordeallocate($image,$backColor);

		if($this->transparent)
			imagecolortransparent($image,$backColor);

		$foreColor = imagecolorallocate($image,
				(int)($this->foreColor % 0x1000000 / 0x10000),
				(int)($this->foreColor % 0x10000 / 0x100),
				$this->foreColor % 0x100);

		if($this->fontFile === null)
			$this->fontFile = dirname(__FILE__) . '/Duality.ttf';

		$length = strlen($code);
		$box = imagettfbbox(30,0,$this->fontFile,$code);
		$w = $box[4] - $box[0] + $this->offset * ($length - 1);
		$h = $box[1] - $box[5];
		$scale = min(($this->width - $this->padding * 2) / $w,($this->height - $this->padding * 2) / $h);
		$x = 10;
		$y = round($this->height * 27 / 40);
		for($i = 0; $i < $length; ++$i) {
			$fontSize = (int)(rand(26,32) * $scale * 0.8);
			$angle = rand(-10,10);
			$letter = $code[$i];
			$box = imagettftext($image,$fontSize,$angle,$x,$y,$foreColor,$this->fontFile,$letter);
			$x = $box[2] + $this->offset;
		}

		imagecolordeallocate($image,$foreColor);

		header('Pragma: public');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Content-Transfer-Encoding: binary');
		header("Content-type: image/png");
		imagepng($image);
		imagedestroy($image);
	}
	
}

?>