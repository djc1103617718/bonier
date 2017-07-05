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
                        ],
                    ],

                    [
                        'label' => '商品管理',
                        'icon' => 'indent',
                        'url' => '#',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            ['label' => '商品列表', 'url' => ['product/index'],],
                            ['label' => '添加商品', 'url' => ['product/create'],],
                        ],
                    ],
                    [
                        'label' => '店铺信息',
                        'icon' => 'square',
                        'url' => '#',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            ['label' => '店铺详情', 'url' => ['address/view'],],
                        ],

                    ],
                    [
                        'label' => '账户信息',
                        'icon' => 'user',
                        'url' => '#',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            ['label' => '账户详情', 'url' => ['user/view'],],
                            ['label' => '更新账户', 'url' => ['user/reset-request', 'type' => 1],],
                            ['label' => '修改密码', 'url' => ['user/reset-request'],],
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
                        'icon' => 'reorder',
                        'url' => ['order/index'],
                        'options' => ['style' => 'font-size:18px'],
                        /*'items' => [
                            ['label' => '新消息', 'url' => ['notice/new-index'],],
                        ]*/
                    ],

                    [
                        'label' => '上传管理',
                        'icon' => 'cloud-upload',
                        'url' => '',
                        'options' => ['style' => 'font-size:18px'],
                        'items' => [
                            ['label' => '轮播图上传', 'url' => ['upload/top-carousel'],],
                            ['label' => '商品图片上传', 'url' => ['upload/product-img']],
                            ['label' => '门店地址图片上传', 'url' => ['upload/address-img']],
                            ['label' => '背景音乐上传', 'url' => ['upload/backend-music']],
                            ['label' => '图片列表', 'url' => ['media/index']],
                            ['label' => '音频列表', 'url' => ['media/music-index']],

                        ]
                    ],

                ],
            ]
        ) ?>
    </section>

</aside>
