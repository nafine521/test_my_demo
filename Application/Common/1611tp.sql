CREATE DATABASE 1611tp
--创建管理员表
CREATE table tp_admin(
    id tinyint unsigned PRIMARY KEY AUTO_INCREMENT COMMENT '管理员ID',
    username varchar(20) not null DEFAULT '' COMMENT '管理员账号',
    password CHAR(32) not null DEFAULT '' COMMENT '密码',
    nickname VARCHAR(20) NOT NULL DEFAULT '' COMMENT '昵称',
    email VARCHAR( 50 ) NOT NULL DEFAULT '' COMMENT '邮箱',
    login_num int unsigned NOT NULL DEFAULT 0 COMMENT '登陆次数',
    login_ip VARCHAR(20) NOT NULL DEFAULT '' COMMENT '上次登陆IP',
    login_time int unsigned NOT NULL DEFAULT 0 COMMENT '上次登陆时间',
    lid int unsigned not null DEFAULT 0 comment '权限id'
)charset=utf8 engine='myisam' comment '管理员表'

insert into tp_admin(username,password,nickname) VALUES("admin",md5("admin"),"超级无敌管理员")

-- 导航表
CREATE table tp_nav(
    id tinyint unsigned PRIMARY KEY AUTO_INCREMENT COMMENT '导航ID',
    name varchar(20) not null DEFAULT '' COMMENT '名称',
    link VARCHAR(50) not null DEFAULT '' COMMENT '链接',
    local tinyint unsigned NOT NULL DEFAULT 0 COMMENT '位置',
    is_show tinyint unsigned NOT NULL DEFAULT 0 COMMENT '是否显示',
    is_open_new tinyint unsigned NOT NULL DEFAULT 0 COMMENT '是否打开新窗口',
    sort tinyint unsigned NOT NULL DEFAULT 0 COMMENT '排序'
)charset=utf8 engine='myisam' comment '导航表'
-- 头部导航
INSERT into tp_nav(name,link,is_show) VALUES("品牌资讯","brand/introduction",1),("联系我们","Contact/contact",1),("新闻中心","News/news",1),("产品中心","Product/product",1)
-- 侧边导航
INSERT into tp_nav(name,link,is_show,local) VALUES("品牌资讯","brand/introduction",1,1),("客户服务","Contact/contact",1,1),("新闻情报","News/news",1,1),("产品中心","Product/product",1,1),("加入我们","Contact/contact",1,1)
-- 会员导航
INSERT into tp_nav(name,link,is_show,local) VALUES("我的购物车","Member/cart",1,2),("账号管理","Contact/contact",1,2),("订单管理","News/news",1,2),("交易管理","Product/product",1,2),("积分兑换","Contact/contact",1,2);


-- 栏目表
CREATE table tp_category(
    id tinyint unsigned PRIMARY KEY AUTO_INCREMENT COMMENT '导航ID',
    name varchar(20) not null DEFAULT '' COMMENT '名称',
    pid tinyint unsigned NOT NULL DEFAULT 0 COMMENT '父id',
    sort tinyint unsigned NOT NULL DEFAULT 0 COMMENT '排序'
)charset=utf8 engine='myisam' comment '栏目表'



-- 用户表
CREATE table tp_user(
    id tinyint unsigned PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
    username varchar(20) not null DEFAULT '' COMMENT '用户账号',
    compellation varchar(20) not null DEFAULT '' COMMENT '真实姓名',
    password CHAR(32) not null DEFAULT '' COMMENT '密码',
    membership tinyint unsigned not null DEFAULT 0 comment '会员等级',
    img VARCHAR( 50 ) NOT NULL DEFAULT '' COMMENT '头像',
    sex tinyint unsigned not null DEFAULT 0 comment '性别0：女1：男',
    address varchar(100) not null DEFAULT '' comment '地址',
    absolute_address varchar(100) not null DEFAULT '' comment '具体地址',
    tel char(11) not null DEFAULT '' comment '手机号码',
    email varchar(50) not null DEFAULT '' comment '邮箱',
    birthday varchar(10) not null default '' comment '生日',
    active tinyint not null default 0 comment '激活状态',
    register_time int not null default  0 comment '注册时间',
    login_time int not null default 0 comment '上次登录时间',
    safe tinyint not null default 0 comment '0:不安全1:中等2:安全'
)charset=utf8 engine='myisam' comment '用户表'

insert into tp_user(username,password) VALUES("admin",md5("admin"))

-- banner图表
CREATE table tp_banner(
    id tinyint unsigned PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
    name varchar(20) not null DEFAULT '' COMMENT '名称',
    local tinyint unsigned NOT NULL DEFAULT 0 COMMENT '位置,0为首页，1是其他页面',
    is_show tinyint unsigned NOT NULL DEFAULT 0 COMMENT '是否显示',
    img VARCHAR(100) not null DEFAULT '' comment '图片'
)charset=utf8 engine='myisam' comment 'banner图表'

-- 新闻表
CREATE TABLE tp_news(
  id tinyint unsigned PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  title VARCHAR(50) NOT NULL DEFAULT '' COMMENT '新闻标题',
  series_id tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT '系列id',
  refer tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT '热门推荐',
  keyword VARCHAR(100) NOT NULL DEFAULT '' COMMENT '关键词',
  content VARCHAR(500) NOT NULL DEFAULT '' COMMENT '新闻内容',
  pubdate int unsigned not null DEFAULT 0 comment '发布时间'
)charset=utf8 engine='myisam' comment '新闻表'

-- 产品系列描述
CREATE TABLE tp_series(
  id tinyint unsigned PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  img VARCHAR(50) NOT NULL DEFAULT '' COMMENT '系列产品图',
  logo VARCHAR(50) NOT NULL DEFAULT '' COMMENT '系列logo图',
  description VARCHAR(200) NOT NULL DEFAULT '' COMMENT '系列描述',
  cat_id tinyint unsigned not null DEFAULT 0 comment ''
)charset=utf8 engine='myisam' comment '产品系列描述表'

-- 产品表
CREATE TABLE tp_product(
  id tinyint unsigned PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  series_id tinyint unsigned not null DEFAULT 0 comment '系列id',
  goods_sn VARCHAR(15) not null DEFAULT '' comment '商品编号',
  name VARCHAR(30) not null DEFAULT '' comment '产品名',
  img VARCHAR(50) not null DEFAULT '' comment '产品图片',
  official_price decimal(6,2) not null DEFAULT 0.00 comment '官方价格',
  capacity SMALLINT unsigned not null DEFAULT 0 comment '容量',
  virtue VARCHAR(200) not null DEFAULT '' comment '功效',
  description VARCHAR(200) not null DEFAULT  '' comment '产品描述',
  goods_number int unsigned not null DEFAULT 0 comment '商品库存',
  promo_price decimal(6,2) unsigned not null DEFAULT 0 comment '是否促销',
  promo_on int unsigned not null DEFAULT 0 comment '促销开始时间',
  promo_off int unsigned not null DEFAULT 0 comment '促销结束时间',
  is_sale tinyint unsigned not null DEFAULT 0 comment '是否上架',
  is_trash tinyint unsigned not null DEFAULT 0 comment '是否删除',
  pubdate int unsigned not null DEFAULT 0 comment '发布时间'
)charset=utf8 engine='myisam' comment '产品表'

-- 产品相册表
CREATE TABLE tp_pro_photo(
  id tinyint unsigned PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  pro_id tinyint unsigned not null DEFAULT 0 COMMENT '产品id',
  img VARCHAR(50) not null DEFAULT '' COMMENT '图片路径'
)charset=utf8 engine='myisam' comment '产品相册表'

-- 留言表
CREATE TABLE tp_feedback(
  id tinyint unsigned PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  name varchar(20) not null default '' comment '姓名',
  tel varchar(20) not null default '' comment '联系电话',
  email VARCHAR(50) not null default '' comment '邮箱',
  contents text not null comment '留言内容',
  pubdate int unsigned not null default 0 comment '留言时间'
)charset=utf8 engine='myisam' comment '留言表'

-- 重构购物车表
create table tp_cart(
   pro_id TINYINT UNSIGNED not null comment '产品ID',
   order_id TINYINT UNSIGNED not null comment '订单ID',
   s_num TINYINT UNSIGNED not null comment '购买数量',
   trans_price decimal(6,2) unsigned not null DEFAULT 0 COMMENT '交易价格',
   primary key (pro_id, order_id)
)charset=utf8 engine='myisam' comment '购物车表'
-- 订单表
create table tp_order(
   id tinyint unsigned not null PRIMARY KEY AUTO_INCREMENT comment '用户ID',
   user_id tinyint unsigned not null DEFAULT 0 comment '顾客(用户)id',
   original_price decimal(6,2) unsigned not null DEFAULT 0 COMMENT '商品原价',
   cat_name varchar(20) not null default 0 comment '产品系列关联栏目名',
   order_sn varchar(15) not null default 0 comment '订单编号',
   order_date int unsigned not null default 0 comment '订单时间'
)charset=utf8 engine='myisam' comment '订单表';

alter table tp_cart add constraint FK_b_id foreign key (order_id)
      references tp_order(id) on delete restrict on update restrict;

alter table tp_cart add constraint FK_u_id foreign key (pro_id)
      references tp_product(id) on delete restrict on update restrict;


CREATE TABLE tp_address
(
  id SMALLINT(6) NOT NULL AUTO_INCREMENT,
  uid TINYINT(4) DEFAULT '0' NOT NULL COMMENT '用户id',
  province VARCHAR(20) DEFAULT '' NOT NULL COMMENT '省市区',
  detail_address VARCHAR(20) DEFAULT '0' NOT NULL COMMENT '详细地址',
  status TINYINT(4) DEFAULT '0' NOT NULL COMMENT '用户默认地址设置为1'
)charset=utf8 engine='myisam' comment '订单表';










 -- 购物车表   #####已弃用
CREATE TABLE tp_cart(
  id tinyint unsigned PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  pro_id tinyint unsigned not null DEFAULT 0 COMMENT '产品id',
  original_price decimal(6,2) unsigned not null DEFAULT 0 COMMENT '商品原价',
  trans_price decimal(6,2) unsigned not null DEFAULT 0 COMMENT '交易价格',
  quantity smallint unsigned NOT null default 0 comment '购买数量',
  cat_name varchar(20) not null default 0 comment '产品系列关联栏目名',
  order_sn varchar(15) not null default 0 comment '订单编号',
  order_date int unsigned not null default 0 comment '订单时间'
)charset=utf8 engine='myisam' comment '购物车表'

-- 购物车外键构造参考
create table tp_shopcar
(
   u_id                 int not null comment '用户ID',
   p_id                 int not null comment '产品ID',
   s_num                int not null comment '购买数量',
   s_time               datetime not null comment '采购时间',
   primary key (u_id, b_id)
);
--#外键关系
alter table tp_shopcar add constraint FK_b_id foreign key (b_id)
      references tp_product(p_id) on delete restrict on update restrict;

alter table tp_shopcar add constraint FK_u_id foreign key (u_id)
      references tp_user (u_id) on delete restrict on update restrict;
CREATE TABLE orders(
 orderid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
 customerid INT UNSIGNED NOT NULL,
 amount FLOAT(6,2),
 date DATE NOT NULL,
 order_status CHAR(10),
 ship_name CHAR(60) NOT NULL,
 ship_address CHAR(80) NOT NULL,
 ship_city CHAR(30) NOT NULL,
 ship_state CHAR(20),
 ship_zip CHAR(10),
 ship_country CHAR(20) NOT NULL
);

CREATE TABLE books(
 isbn CHAR(13) NOT NULL PRIMARY KEY,
 author CHAR(80),
 title CHAR(100),
 catid INT UNSIGNED,
 price FLOAT(4,2) NOT NULL,
 description VARCHAR(255)
);

CREATE TABLE order_items(
 orderid INT UNSIGNED NOT NULL,
 isbn CHAR(13) NOT NULL,
 item_price FLOAT(4,2) NOT NULL,
 quantity TINYINT UNSIGNED NOT NULL,
 PRIMARY KEY(orderid,isbn)
);
-- #end