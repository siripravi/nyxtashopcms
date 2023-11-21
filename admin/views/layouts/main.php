<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap5\Breadcrumbs;
\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
//\hail812\adminlte3\assets\AdminLteAsset::register($this);
//app\admin\assets\ThemeAsset::register($this);
app\admin\assets\MainAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

$assetDir = "";//Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

//$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
//$this->registerJsFile($publishedRes[1].'/control_sidebar.js', ['depends' => '\hail812\adminlte3\assets\AdminLteAsset']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>

<body>
	<?php $this->beginBody() ?>
	<div id="app">
		<?= $this->render('mainy_sidebar') ?>

		<div id="main" class='layout-navbar navbar-fixed'>
			<?= $this->render('mainy_header') ?>

			<div id="main-content">
				<?= $this->render('mainy_content', compact('content')) ?>

				<?= $this->render('mainy_footer') ?>
			</div>
		</div>
	</div>

	<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
