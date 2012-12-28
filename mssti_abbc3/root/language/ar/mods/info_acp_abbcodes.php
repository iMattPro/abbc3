<?php
/**
*
* info_acp_abbcodes [Arabic]
*
* @package Advanced BBCode Box 3
* @version $Id$
* @copyright (c) 2010 leviatan21 (Gabriel Vazquez) and VSE (Matt Friedman)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @ translated by hubaishan-http://phpbbarabia.com-http://msofficeword.net
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
// Reference : http://www.phpbb.com/mods/documentation/phpbb-documentation/language/index.php#lang-use-php
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	// These lines are the same as in root/language/en/acp/common.php
	'ACP_ABBCODES'				=> 'صندوق BBCode المتقدم 3',
	'ACP_ABBC3_SETTINGS'		=> 'إعدادات ABBC3',
	'ACP_ABBC3_BBCODES'			=> 'ABBC3 BBCodes',
	'LOG_CONFIG_ABBCODES'		=> '<strong>تغيير إعدادات المحرر ABBC3</strong>',
	'LOG_CONFIG_ABBCODES_ERROR'	=> '<strong>لقد حدث خطأ أثناء حفظ إعدادات المحرر!</strong>',

	// UCP settings
	'UCP_ABBCODES'					=> 'صندوق BBCode المتقدم 3',
	'UCP_ABBC3_SETTINGS'			=> 'واجهة محرر رسائل BBCode',
	'UCP_ABBC3_SETTINGS_EXPLAIN'	=> 'لاحظ أنه في الوضع <i>المحدود</i>، ليس كل BBCode ستكون متاحة فلذا عليك كتابتها يدويًا.',
	'UCP_ABBC3_LIMITED'				=> 'محدود - BBcode أساسية بدون أيقونات',
	'UCP_ABBC3_COMPACT'				=> 'مدمج - كل BBcode في قائمة مدمجة',
	'UCP_ABBC3_STANDARD'			=> 'افتراضي - شريط BBcode كامل',

	// ABBC3 settings page
	'ABBCODES_SETINGS'					=> 'إعدادات ABBC3',
	'ABBCODES_SETINGS_EXPLAIN'			=> 'بإمكانك هنا تكوين <strong>ABBC3</strong>. بإمكانك ضبط مظهر وخيارات شريط أدوات BBCodes. إعدادات "المعالجات" تكوِّن مربعات حوار المساعدة لـABBC3. قسم "محجم الصور" يكوِّن كيفية التعامل أو تحجيم الصور المرسلة أو المرفقة. قسم “BBvideo” يكون إعدادات كود BBvideo.',

	'ABBCODES_VERSION_CHECK'			=> 'فحص الإصدار',
	'ABBCODES_CURRENT_VERSION'			=> 'الإصدار المثبت',
	'ABBCODES_LATEST_VERSION'			=> 'آخر إصدار متاح',
	'ABBCODES_DOWNLOAD_LATEST'			=> 'تحميل آخر إصدار',


	'ABBCODES_DISABLE'					=> 'ABBC3',
	'ABBCODES_DISABLE_EXPLAIN'			=> 'تفعيل <strong> صندوق الـ BBcodes المتقدم 3 </strong> أو تعطيل الصندوق لكي يتحول المحرر إلى المحرر الاعتيادي للأزرار الموجود في phpBB3.',
	'ABBCODES_BG'						=> 'الصورة الخلفية لشريط أدوات BBCode',
	'ABBCODES_BG_EXPLAIN'				=> 'هذا سيقوم بضبط الصورة الخلفية لشريط أدوات BBCode.<br />اضبط إلى <em>لا صورة</em> لاستعمال لون الاستايل الافتراضي.',
	'ABBCODES_TAB'						=> 'إظهار أيقونات التقسيم بين العلامات',
	'ABBCODES_BOXRESIZE'				=> 'محرر قابل للتحجيم',
	'ABBCODES_BOXRESIZE_EXPLAIN'		=> 'يظهر  أزرار +/- لتحجيم منطقة نص محرر المشاركة.',
	'ABBCODES_UCP_MODE'					=> 'خيارات لوحة التحكم',
	'ABBCODES_UCP_MODE_EXPLAIN'			=> 'السماح للمستخدمين باختيار واجهة أزرار BBCode الخاصة بهم عبر الاختيار بين واجهة أزرار ABBC3 “الافتراضي”، أو ABBC3 “المدمج” أو محرر phpBB3 الافتراضي المحدود.',

	'ABBCODES_WIZARD'					=> 'المعالجات',
	'ABBCODES_WIZARD_SIZE'				=> 'أبعاد المعالج',
	'ABBCODES_WIZARD_SIZE_EXPLAIN'		=> 'العرض والارتفاع الافتراضيين لنوافذ المعالجات المنبثقة.',
	'ABBCODES_WIZARD_MODE'				=> 'اختر طريقة المعالج',
##	For translators :								Don't			Yes
	'ABBCODES_WIZARD_SELECTOR'			=> array(	'0'			=> 'تعطيل المعالجات',
													'1'			=> 'نوافذ منبثقة',
													'2'			=> 'AJAX (بدون انبثاق)'),

	'ABBCODES_RESIZER'					=> 'محجم الصور',
	'ABBCODES_RESIZE'					=> 'تحجيم الصور الكبيرة',
	'ABBCODES_RESIZE_EXPLAIN'			=> 'هذا سيحجم الصور المرسلة عبر كود <code>[IMG]</code> أو المرفقة التي يتجاوز عرضها أو/و ارتفاعها الإعدادات المعينة بالأسفل.',
	'ABBCODES_JAVASCRIPT_EXPLAIN'		=> '<strong>ملاحظة:</strong> <em>AdvancedBox JS</em> هو برنامج جافاسكربت لعرض الصور في الحجم الكامل.<br />بإمكانك استعمال ABBC3 مع أي من السكربتات المضمنة الأخرى. هذه الإعدادات هي اختيارية بالكامل. ولكل سكربت دعمه الخاص. ABBC3 غير مسئولة عن أية قضايا عن استعمال سكربت طرف ثالث. كل الاستفسارات/المشاكل/الأخطاء ينبغي أن ترسل إلى مطور السكربت الأصلي.',
	'ABBCODES_RESIZE_METHOD'			=> 'طريقة التحجيم',
	'ABBCODES_RESIZE_METHOD_EXPLAIN'	=> 'اختر كيف سيتم عرض الصور المحجمة في الحجم الكامل.',
	'ABBCODES_RESIZE_BAR'				=> 'شريط معلومات المحجم',
	'ABBCODES_RESIZE_BAR_EXPLAIN'		=> 'عرض معلومات التحجيم في قمة الصور المحجمة.',
##	For translators :								Don't				Yes
	'ABBCODES_RESIZE_METHODS'			=> array(	'AdvancedBox'	=> 'Advanced Box JS',
													'HighslideBox'	=> 'Highslide JS',
													'Lightview'		=> 'Lightview JS',
													'prettyPhoto'	=> 'PrettyPhoto JS',
													'Shadowbox'		=> 'Shadowbox JS',
													'pop-up'		=> 'نافذة منبثقة',
													'enlarge'		=> 'توسيع',
													'samewindow'	=> 'نفس النافذة',
													'newwindow'		=> 'نافذة جديدة',
													'none'			=> 'لا تحجم'),

	'NO_EXIST_EXPLAIN_ADVANCEDBOX'		=> 'الملف <strong>AdvancedBox.js</strong> غير موجود في المُجلّد <em>%1$s</em>',
	'NO_EXIST_EXPLAIN_OTHERS'			=> 'الملف <strong style="font-size:1.1em;">%1$s version %2$s</strong> غير موجود في مجلد <em>%3$s</em>.<br />إذا كنت تود استعمال %4$s، عليك بتحميل ملفات  %4$s من <a href="%5$s" onclick="window.open(this.href);return false;">هنا</a> ثم ارفع <strong style="font-size:1.1em;">%1$s</strong> إلى مجلد <em>%3$s</em>.',

	'ABBCODES_MAX_IMAGE_WIDTH'			=> 'الحد الأقصى لعرض الصورة بالبكسل',
	'ABBCODES_MAX_IMAGE_WIDTH_EXPLAIN'	=> 'سوف يتم تحجيم الصور إذا تجاوز عرضها العرض معين هنا. اضبطه إلى 0 لتجاهل فحص هذا البعد.',
	'ABBCODES_MAX_IMAGE_HEIGHT'			=> 'الحد الأقصى لارتفاع الصورة بالبكسل',
	'ABBCODES_MAX_IMAGE_HEIGHT_EXPLAIN'	=> 'سوف يتم تحجيم الصور إذا تجاوز ارتفاعها الارتفاع معين هنا. اضبطه إلى 0 لتجاهل فحص هذا البعد.',
	'ABBCODES_MAX_THUMB_WIDTH'			=> 'الحد الأقصى لعرض المصغرات بالبكسل',
	'ABBCODES_MAX_THUMB_WIDTH_EXPLAIN'	=> 'المصغرات المكونة بواسطة <code>[THUMBNAIL]</code> BBCode لن تتجاوز العرض المحدد هنا.',
	'ABBCODES_RESIZE_SIGNATURE'			=> 'تصغير أحجام الصور الكبيرة في التواقيع',
	'ABBCODES_RESIZE_SIGNATURE_EXPLAIN'	=> 'هل تريد أيضاً تصغير أحجام الصور الكبيرة في تواقيع الأعضاء؟',
	'ABBCODES_SIG_IMAGE_WIDTH'			=> 'الحد الأقصى لعرض الصور في التواقيع بالبكسل',
	'ABBCODES_SIG_IMAGE_WIDTH_EXPLAIN'	=> 'سوف يتم تحجيم الصور في التواقيع إذا تجاوز عرضها العرض معين هنا. اضبطه إلى  0 لتجاهل فحص هذا البعد.',
	'ABBCODES_SIG_IMAGE_HEIGHT'			=> 'الحد الأقصى لارتفاع الصور في التواقيع بالبكسل',
	'ABBCODES_SIG_IMAGE_HEIGHT_EXPLAIN'	=> 'سوف يتم تحجيم الصور في التواقيع إذا تجاوز ارتفاعها الارتفاع معين هنا. اضبطه إلى  0 لتجاهل فحص هذا البعد.',

	'ABBCODES_VIDEO_ERROR'				=> '<strong>خطأ:</strong>يوجد BBvideo كثيرة محدد، ألغِ تحديد بعض هذه وحاول مرة أخرى.',
	'ABBCODES_VIDEO_SIZE'				=> 'أبعاد الفيديو',
	'ABBCODES_VIDEO_SIZE_EXPLAIN'		=> 'العرض والارتفاع الافتراضيين للفيديو المرسل.<br />اعتيادي: 425 x 350. شاشة عريضة: 560 x 340.',
	'ABBCODES_VIDEO_ALLOWED'			=> 'صيغ الفيديو المسموحة',
	'ABBCODES_VIDEO_ALLOWED_EXPLAIN'	=> 'حدد مواقع الفيديو و/أو صيغ الفيديو التي تودأن تكون متاحة للتضمين في BBvideo BBCode <em class="error">(*)</em>',
	'ABBCODES_VIDEO_ALLOWED_NOTE'		=> '<em class="error">(*)</em> من أجل اختيار (إلغاء اختيار) عدة عناصر، اضغط CTRL+نقرة ماوس (أو CMD+نقرة ماوس في الماك) على العناصر لاخيارها. إذا نسيت الضغط على  CTRL/CMD عند النقر على عنصر, فإن كل الاخيارات السابقة سيلغى تحديدها.',
	'ABBCODES_VIDEO_WMODE'				=> 'نمط نافذة شفافة',
	'ABBCODES_VIDEO_WMODE_EXPLAIN'		=> 'Sets the Flash variable “wmode” to transparent. This is only needed if your forum has a layered static object (such as a footer toolbar) and the embedded videos are being rendered on top of the static object.',


	'ABBCODES_DESELECT_ALL'				=> 'إلغاء اختيار الكل',
	'ABBCODES_SELECT_ALL'				=> 'اختيار الكل',

	// ABBC3 BBCodes page
	'ABBCODES_CONFIG'					=> 'ABBC3 BBCodes',
	'ABBCODES_CONFIG_EXPLAIN'			=> 'هنا بإمكانك تكوين ترتيب الـ BBCode في شريط الأدوات (اسحب وأفلت أسطر الجدول للترتيب) وعدل الخيارات لكل BBCode.',

	'ABBCODES_EDIT'						=> 'خيارات ABBC3 BBCode',
	'ABBCODES_EDIT_EXPLAIN'				=> 'هنا بإمكانك تحديد أين سيظهر هذا الـ BBCode، من بإمكانه استعماله، وتعيين أيقونة له.',

	'ABBCODES_GROUPS_EXPLAIN'			=> '<strong>إدارة المجموعات:</strong> إذا لم تحدد أية مجموعة فإم كل المستخدمين بإمكانهم استعمال هذا الـ BBCode.<br />من أجل اختيار (أو إلغاء اختيار) عدة مجموعات عليك الضعط على CTRL مع النقر (أو  CMDمن النقر في الماك) على العناصر لاختيارها. إذا نسيت الضغط على  CTRL/CMD أثناء النقر على عنصر فإن كل العناصر المحددة مسبقًا سيتم إلغاء تحديدها.',

	'ABBCODES_TIP'						=> 'تلميح العلامة',
	'ABBCODES_NAME'						=> 'علامة BBCode',
	'ABBCODES_TAG'						=> 'صورة إيقونة العلامة',
	'ABBCODES_ORDER'					=> 'ترتيب العلامة',
	'ABBCODES_CUSTOM'					=> 'BBCode مخصص',

	'ABBCODES_BREAK_MOVER'				=> '<strong><i>خط فاصل</i></strong>',
	'ABBCODES_DIVISION_MOVER'			=> '<strong><i>صورة فاصلة بين الأيقونات</i></strong>',
	'ABBCODES_ADD_DIVISION'				=> 'إضافة أيقونة فاصلة بين الأيقونات',
	'ABBCODES_ADD_BREAK'				=> 'إضافة خط فاصل جديد',
	'ABBCODES_SYNC'						=> 'إعادة مزامنة الترتيب',
	'ABBCODES_RESYNC_SUCCESS'			=> 'تم إعاداة مزامنة الـ BBcode بنجاح',

	'ABBCODES_COLOUR_MODE'				=> 'اختر طريقة محدد الألوان',
##	For translators :								Don't			Yes
	'ABBCODES_COLOUR_SELECTOR'			=> array(	'phpbb'		=> 'نمط phpBB الافتراضي',
													'dropdown'	=> 'قائمة منسدلة',
													'fancy'		=> 'محدد فانسي',
													'tigra'		=> 'محدد ألوان تيغرا'),

	'ABBCODES_MOD_DISABLE'				=> '<strong>صندوق BBCode المتقدم 3</strong> معطل.<br />',
	'ABBCODES_STATUS'					=> 'الحالات',
	'ABBCODES_ACTIVATED'				=> 'مُفعّل',
	'ABBCODES_DEACTIVATED'				=> 'معطل',

	// UMIL Installer
	// Main
	'INSTALLER_TITLE'					=> 'صندوق BBCode المتقدم 3',
	'INSTALLER_TITLE_EXPLAIN'			=> 'مرحبًا بك إلى قائمة تنصيب<strong>ABBC3</strong>',
	'INSTALLER_INSTALL_WELCOME'			=> 'قبل تثبيت ABBC3',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'تنبَّه أن هذه العملية ستقوم بمحو كل الـ BBCode المخصصة، وكنتيجة لذلك هذه الـ BBCode يمكن أن لا تعرض نتائج صحيحة نتيجةً للتغيرات التي قام بها ABBC3.
											<br /><br />إذا واجهت مشاكل مع BBCode لم تعد تعمل في مشاركات حالية استعمل <a href="http://www.phpbbarabia.com/stk.php" title="" onclick="window.open(this.href);return false;">حزمة أدوات الدعم <em>(STK)</em></a> خاصية<strong>أدوات الإدارة » إعادة توزيع BBCode</strong>.
											<br /><br />قبل إضافة هذا الهاك إلى منتداك، يجب عمل نسخ احتياطي للملفات المتعلقة وقاعدة البيانات.',
	// Stages
	'INSTALLER_CONFIGS_ADD'				=> 'إعدادات ABBC3',
	'INSTALLER_BBCODES_ADD'				=> 'أكواد ABBC3 bbcodes',
	// Misc
	'INSTALLER_RESIZE_CHECK'			=> 'تم فحص تحديث عملية المحجم',
	'INSTALLER_BBVIDEO_UPDATER'			=> 'تم تحديث الـBBvideos',
));

?>