<?php
/**
 * Created by PhpStorm.
 * User: ethl
 * Date: 2016/12/28
 * Time: 20:43
 */

namespace Home\Controller;
use Think\Controller;

class NewsController extends PublicController
{
    /*给总记录条数赋值为静态*/
    static private $count ;

	public function news()
	{
        $news = M('news'); // 实例化User对象
        $count      = $news->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page(self::$count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev',"上一页");
        $Page->setConfig('next',"下一页");
        $show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性

        /*搜索关键字*/
        $search_word=I("keyword");
        if (!empty($search_word))$where["tp_news.name"]=array("like","%".$search_word."%");

        $list = $news->field("tp_news.*,tp_series.cat_id")->join("left join tp_series on tp_news.series_id=tp_series.id")->order('pubdate desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        self::$count      = count($list);// 当有搜索条件筛选进行重新赋值


        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出

		$this->display();
	}
        // 新闻详情
        public function news_detail()
        {
                $news = M('news');
                $id=I("get.id");
                if (empty($id)) {
                     $info=$news->order("pubdate desc")->find();

                }else{
                     $info=$news->find($id);
                }

                /*实现union查询上下篇失败。。。。。
                try{
                $b=M("news")->field('id,name')
                ->union(array('SELECT name FROM tp_news where id <'.$info['id'].' order by id desc','SELECT name FROM tp_news where id >'.$info['id'].' order by id '),true)
                ->select();}catch(\Exception $e){echo $a->error;}*/
                $front=$news->where("id<".$info['id'])->order("id desc")->find();
                $next=$news->where("id>".$info['id'])->order("id asc")->find();

                /*查询系列*/
                $series_info=M("series")->find($info['series_id']);
                /*查询相关新闻*/
                $relat_where=array(
                        "series_id"=>$info['series_id'],
                        "id"=>array("neq",$info['id']),
                );
                $relation_news=$news->where($relat_where)->select();
                /*还有热门推荐*/
								$refer_where= array('refer' => 1 );
								$refer_list=$news->where($refer_where)->order("pubdate desc")->select();
								// 传值
								$this->assign("refer_list",$refer_list);
                $this->assign("relation_news",$relation_news);
                $this->assign("series_info",$series_info);
                $this->assign("next",$next);
                $this->assign("front",$front);
                $this->assign("info",$info);
                $this->display();
        }
}
