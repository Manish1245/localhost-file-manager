<md-card class="m-0">
    <md-card-content layout="row">
        <div flex>
            <md-input-container>
                <input type="text" ng-model="filters.search" ng-model-options="{debounce: '500'}" placeholder="Search">
            </md-input-container>
        </div>
        <md-button ng-click="get()" class="md-icon-button">
            <md-tooltip>Refresh</md-tooltip>
            <i class="fa fa-sync"></i>
        </md-button>
        <md-button ng-click="removeAll()" class="md-icon-button">
            <md-tooltip>Delete Selected</md-tooltip>
            <i class="fa fa-trash"></i>
        </md-button>
    </md-card-content>
</md-card>
<div layout="row" layout-padding layout-wrap>
    <div flex>
        <md-card class="m-0">
            <md-list class='p-0'>
                <md-list-item ng-click="changeDir(item)" ng-repeat="item in files">
                    <div flex layout="row" layout-wrap layout-padding layout-align="start center">
                        <div flex="none">
                            <md-checkbox class="m-0" ng-model="item.selected"></md-checkbox>
                        </div>
                        <div flex="none">
                            <i class="fa fa-2x {{item.icon.classes}}"></i>
                        </div>
                        <div flex="none" layout="column">
                            <!--<md-tooltip md-direction="top">{{item.name}}</md-tooltip>-->
                            <span class="font-12 font-weight-bold md-truncate">{{item.name}}</span>
                            <span class="font-10 text-muted">{{item.mime}}</span>
                        </div>
                        <div flex>

                        </div>
                        <div flex="none">
                            <md-menu ng-if="!item.is_dir">
                                <md-button ng-click="$mdMenu.open($event)" class="md-icon-button m-0">
                                    <i class="fa fa-ellipsis-v"></i>
                                </md-button>
                                <md-menu-content>
                                    <md-menu-item ng-if="item.is_editable">
                                        <md-button ng-click="edit(item, $event)">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </md-button>
                                    </md-menu-item>
                                    <!--                                    <md-menu-item>
                                                                            <md-button ng-click="rename(item, $event)">
                                                                                <i class="fa fa-pencil-alt"></i>
                                                                                Rename
                                                                            </md-button>
                                                                        </md-menu-item>
                                                                        <md-menu-item>
                                                                            <md-button ng-click="copy(item, $event)">
                                                                                <i class="fa fa-copy"></i>
                                                                                Copy
                                                                            </md-button>
                                                                        </md-menu-item>
                                                                        <md-menu-item>
                                                                            <md-button ng-click="copy(item, $event)">
                                                                                <i class="fa fa-cut"></i>
                                                                                Cut
                                                                            </md-button>
                                                                        </md-menu-item>-->
                                    <md-menu-item>
                                        <md-button ng-click="remove(item, $event)">
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </md-button>
                                    </md-menu-item>
                                </md-menu-content>
                            </md-menu>
                        </div>
                    </div>
                </md-list-item>
                <md-list-item>
                    <h4 class="p-4" ng-if="!$root.progress && !files.length" class="text-center">No files in this directory</h4>
                </md-list-item>
            </md-list>
        </md-card>
    </div>
</div>
<md-fab-speed-dial md-open="fabOpen" md-direction="up" class="md-scale md-fab-bottom-right position-fixed">
    <md-fab-trigger>
        <md-button aria-label="menu" class="md-fab md-warn">
            <i class="fa fa-plus"></i>
        </md-button>
    </md-fab-trigger>

    <md-fab-actions>
        <md-button ng-click="createFile($event)" aria-label="Create File" class="md-fab md-raised md-mini">
            <md-tooltip md-direction="left">Create File</md-tooltip>
            <i class="fa fa-file"></i>
        </md-button>
        <md-button ng-click="createFolder($event)" aria-label="Create File" class="md-fab md-raised md-mini">
            <md-tooltip md-direction="left">Create Folder</md-tooltip>
            <i class="fa fa-folder"></i>
        </md-button>
    </md-fab-actions>
</md-fab-speed-dial>