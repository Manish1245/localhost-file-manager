<html ng-app="<?= $app->name() ?>">
    <head>
        <?= $app->html()->title() ?>
        <?= $app->bower()->tags_string() ?>
        <?= $app->html()->main_script() ?>
        <?=
        $app->asset("run.js")->tag([
            "version" => time()
        ])
        ?>
        <?=
        $app->asset("style.css")->tag([
            "version" => time()
        ])
        ?>
    </head>
    <body layout="column">
    <md-toolbar class="md-whiteframe-z2">
        <div class="md-toolbar-tools" layout="row">
            <!--            <md-button class="md-icon-button">
                            <i class="fa fa-bars"></i>
                        </md-button>-->
            <h1 flex class="md-title">
                File Manager
            </h1>
            <span flex="none" class="font-12">
                Created by <a target="_blank" href="http://www.technicalbros.com">Technical Bros</a>
            </span>
        </div>
    </md-toolbar>
    <md-content flex>
        <div ui-view class="main-view"></div>
    </md-content>
    <md-progress-linear ng-show="$root.progress" style='position:fixed;top:0;z-index: 100' class='md-accent'></md-progress-linear>
</body>
</html>