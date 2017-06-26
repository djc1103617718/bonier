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
                        'label' => '活动管理',
                        'icon' => 'th-list',
                        'url' => '#',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            ['label' => '活动列表', 'url' => ['activity/index'],],
                            ['label' => '执行详情', 'url' => ['job-execution/index'],],
                        ],
                    ],

                    [
                        'label' => '商品管理',
                        'icon' => 'indent',
                        'url' => '#',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            ['label' => '商品列表', 'url' => ['product/index'],],
                        ],
                    ],
                    [
                        'label' => '店铺信息',
                        'icon' => 'users',
                        'url' => '#',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            ['label' => '店铺详情', 'url' => ['address/view'],],
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
                        'label' => '订单管理',
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

                ],
            ]
        ) ?>
    </section>

</aside>
