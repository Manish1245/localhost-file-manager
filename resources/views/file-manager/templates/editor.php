<div ui-ace="{
     mode:file.ace_mode,
     theme: 'xcode',require: ['ace/ext/language_tools','ace/ext/beautify'],
     advanced: {
     enableSnippets: true,
     enableBasicAutocompletion: true,
     enableLiveAutocompletion: true
     }
     }" ng-model="file.contents" ng-keydown="keypress($event)"></div>
<md-toolbar>
    <div class="md-toolbar-tools" layout="row">
        <div flex>
            <md-button class="m-0" href="{{file.url}}" target="_blank">
                <i class="fa fa-link"></i>
                Run
            </md-button>
        </div>
        <md-button class="m-0" ng-click="save()">
            <i class="fa fa-save"></i>
            Save
        </md-button>
        <md-button class="m-0" ng-click="close()">
            <i class="fa fa-times"></i>
            Close
        </md-button>
    </div>
</md-toolbar>
<style>
    .ace_editor { height: calc(100% - 128px); }
</style>