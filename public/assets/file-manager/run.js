angular.module($appName)

        .config([
            '$stateProvider',
            '$urlRouterProvider',
            '$crudProvider',
            ($stateProvider, $urlRouterProvider, $crudProvider) => {

                $urlRouterProvider.otherwise("/")

                $crudProvider.setBaseUrl($servicesUrl);

                $stateProvider

                        .state("home", {
                            url: "/?path",
                            title: "Home",
                            templateUrl: getTemplateUrl("home"),
                            controller: [
                                '$scope',
                                '$crud',
                                '$state',
                                '$stateParams',
                                function ($scope, $crud, $state, $stateParams) {

                                    $scope.filters = {};
                                    $scope.filters.path = $stateParams.path;

                                    $scope.get = () => $crud.retrieve("files", $scope.filters, {
                                            scope: $scope
                                        }).then((data) => {
                                            console.log(data)
                                        });


                                    $scope.changeDir = (item) => {
                                        if (item.is_dir) {
                                            $state.go("home", {
                                                path: item.relative_path
                                            })
                                        } else {
                                            $scope.edit(item);
                                        }
                                    }

                                    $scope.edit = (item) => {
                                        $state.go("editor", {
                                            path: item.relative_path
                                        })
                                    }

                                    $scope.remove = (item, e) => {
                                        $crud.confirm({
                                            targetEvent: e
                                        }).then(() => {
                                            $crud.remove("file", {
                                                path: item.relative_path
                                            }).then($scope.get);
                                        })
                                    }

                                    $scope.removeAll = (e) => {
                                        var files = _.filter($scope.files, (item) => {
                                            return item.selected;
                                        })

                                        if (!files.length) {
                                            return $crud.alert({
                                                title: "No files selected",
                                                textContent: "Please select at least one file to delete"
                                            })
                                        }

                                        $crud.confirm({
                                            title: "Do you want to delete the selected " + files.length + " file(s) or folder(s)",
                                            targetEvent: e
                                        }).then(() => {
                                            $crud.remove("file", {
                                                paths: _.map(files, 'relative_path')
                                            }).then($scope.get);
                                        })
                                    }

                                    $scope.createFile = (e) => {
                                        $crud.prompt({
                                            title: "Enter the name for the file",
                                            targetEvent: e
                                        }).then((name) => {
                                            $crud.create("file", {
                                                name: name,
                                                path: $scope.filters.path
                                            }).then((data) => {
                                                $crud.confirm({
                                                    title: "Do you want to edit the file contents?",
                                                    textContent: "Code editor will be opened for editing.",
                                                    cancel: "No, Leave it",
                                                    ok: "Yes! Do it"
                                                }).then(() => {
                                                    $scope.edit(data.file)
                                                }, $scope.get)
                                            })
                                        })
                                    }

                                    $scope.createFolder = (e) => {
                                        $crud.prompt({
                                            title: "Enter the name for the folder",
                                            targetEvent: e
                                        }).then((name) => {
                                            $crud.create("folder", {
                                                name: name,
                                                path: $scope.filters.path
                                            }).then($scope.get)
                                        })
                                    }

                                    $scope.$watch("filters", $scope.get, true);
                                }
                            ]
                        })

                        .state("editor", {
                            url: "/editor/?path",
                            title: "Code Editor",
                            templateUrl: getTemplateUrl("editor"),
                            resolve: {
                                file: [
                                    '$crud',
                                    '$stateParams',
                                    ($crud, $stateParams) => $crud.retrieve("file", {
                                            path: $stateParams.path
                                        }).then(data => data.file)
                                ]
                            },
                            controller: [
                                '$scope',
                                '$crud',
                                '$state',
                                '$stateParams',
                                function ($scope, $crud, $state, $stateParams) {
                                    $scope.file = $scope.$resolve.file;

                                    $scope.save = () => $crud.update("file", $scope.file);


                                    $scope.keypress = (e) => {
//                                        console.log(e.keyCode)
                                        switch (e.keyCode) {
                                            case 83:
                                                if (e.ctrlKey) {
                                                    e.preventDefault();
                                                    $scope.save();
                                                }
                                                break;

                                            case 79:
                                                if (e.ctrlKey) {
                                                    e.preventDefault();
                                                    $scope.open();
                                                }
                                                break;

                                            default:

                                                break;
                                        }
                                    }

                                    $scope.open = () => {
                                        window.open($scope.file.url)
                                    }

                                    $scope.close = () => {
                                        window.history.back();
                                    }
                                }
                            ]
                        })
            }
        ])