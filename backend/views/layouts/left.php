<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="<?/*= $directoryAsset */?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->

        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    [
                        'label' => '任务管理',
                        'icon' => 'th-list',
                        'url' => '#',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            ['label' => '创建任务', 'url' => ['task-template/app'],],
                            [
                                'label' => '任务列表',
                                'url' => '#',
                                'items' => [
                                    ['label' => '新任务', 'url' => ['job/new-index'],],
                                    ['label' => '待执行任务', 'url' => ['job/awaiting-index'],],
                                    ['label' => '执行中任务', 'url' => ['job/executing-index'],],
                                    ['label' => '已完成任务', 'url' => ['job/complete-index'],],
                                    ['label' => '审核失败任务', 'url' => ['job/cancel-index'],],
                                    ['label' => '撤销的任务', 'url' => ['job/revoke-index']],
                                    ['label' => '草稿箱', 'url' => ['job/draft-index'],],
                                    ['label' => '所有任务', 'url' => ['job/index'],],
                                ],
                            ],
                            ['label' => '执行详情', 'url' => ['job-execution/index'],],
                        ],
                    ],

                    [
                        'label' => '账号管理',
                        'icon' => 'indent',
                        'url' => '#',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            [
                                'label' => '微信账号',
                                'url' => '#',
                                'items' => [
                                    ['label' => '微信账号列表', 'url' => ['we-chat/index'],],
                                    ['label' => '今日注册微信', 'url' => ['we-chat/register'],],
                                    ['label' => '今日被封微信', 'url' => ['we-chat/seal'],],
                                    ['label' => '今日养号微信', 'url' => ['we-chat/raising-index'],],
                                    ['label' => '账号任务日志', 'url' => ['account-job-log/index'],],
                                    ['label' => '微信在线时长', 'url' => ['wechat-online-time/index'],],
                                ],
                            ],
                            [
                                'label' => '账号注册统计',
                                'url' => '#',
                                'items' => [
                                    ['label' => '贴吧账号注册情形', 'url' => ['user-tieba/index'],],
                                    //['label' => '360账号列表', 'url' => ['user-qihu360-mobile/index'],],
                                    //['label' => '每日账号统计', 'url' => ['register-daily-statistics/index'],],
                                    /*[
                                        'label' => '当下注册与登录',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => '360账号', 'url' => ['register-daily-statistics/current360'],],
                                            ['label' => '壁纸账号', 'url' => ['register-daily-statistics/current-bizhi'],],
                                            ['label' =>  '搜狗浏览器', 'url' => ['register-daily-statistics/current-sougou'],],
                                        ],
                                    ],*/
                                ]
                            ],
                        ],
                    ],
                    [
                        'label' => '商户管理',
                        'icon' => 'users',
                        'url' => '#',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            ['label' => '商户列表', 'url' => ['user/index'],],
                            ['label' => '新增商户', 'url' => ['user/create'],],
                        ],

                    ],
                    /*[
                        'label' => '管理员管理',
                        'icon' => 'users',
                        'url' => '#',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            ['label' => '管理员列表', 'url' => ['user/index'],],
                            ['label' => '新增商户', 'url' => ['user/create'],],
                        ],

                    ],*/
                    [
                        'label' => '消息管理',
                        'icon' => 'commenting',
                        'url' => '#',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            ['label' => '新消息', 'url' => ['notice/new-index'],],
                            ['label' => '所有消息', 'url' => ['notice/index'],],
                            ['label' => '消息推送', 'url' => ['notice/send'],],

                            /*['label' => '消息分类管理', 'url' => '#',
                                'items' => [
                                    ['label' => '所有分类', 'url' => ['notice-category/index'],],
                                    ['label' => '创建类别', 'url' => ['notice-category/create'],],
                                ]
                            ],*/

                        ]
                    ],

                    [
                        'label' => '资金管理',
                        'icon' => 'bar-chart',
                        'url' => '',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            ['label' => '资金记录', 'url' => ['funds-record/index'],],
                        ]
                    ],

                    [
                        'label' => '权限管理',
                        'icon' => 'table',
                        'url' => '#',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            ['label' => '角色/权限分配列表', 'url' => ['/auth-management/auth-assignment/index'],],
                            ['label' => '角色/权限关系列表', 'url' => ['/auth-management/auth-item-child/index'],],
                            ['label' => '角色/权限列表', 'url' => ['/auth-management/auth-item/index'],],
                            ['label' => '规则列表', 'url' => ['/auth-management/auth-rule/index'],],
                        ]
                    ],

                ],
            ]
        ) ?>
    </section>

</aside>
