<?php
/**
 * Created by PhpStorm.
 * User: ethl
 * Date: 2016/12/22
 * Time: 22:26
 */

namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller
{
    
    //初始化函数
    public function  _initialize(){
        if (!cookie("1611_admin")) {
            if(!session("?tp1611_admin")){
                $this->redirect('index/login');
            }
        }
        //栏目数据
        $this->category_list=M("category")->select();
        $this->series_list=M("series")->select();
    }
    // 修改值
    public function status()
    {
        $primary=I("post.primary");
        $tableName=I("post.tableName");
        $id=I("post.id");
        $fieldName=I("post.fieldName");
        $fieldVal=I("post.fieldVal");
        $db=M($tableName);
        $where[$primary]=$id;
        $b=$db->where($where)->setField($fieldName,$fieldVal);
        if($b){
            $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
        }else{
            $this->ajaxReturn(array("status"=>"n","info"=>"操作失败",I("post.")));
        }
    }

    public function uploadImg()
        {
           
            $path=I("get.path");
            
            $info=upload($_FILES['imgFile'],$path);
            
            $tmp="/Uploads/".$info['savepath'].$info['savename'];


            if(!$info) {
                // 上传错误提示错误信息        
                $this->ajaxReturn(array("error"=>1,"info"=>$info->getError()));
            }else{
                // 上传成功 
                $this->ajaxReturn(array("error"=>0,"url"=>$tmp));
            }
        }

    //百度上传插件 没时间实现了。。。。
    public function uploadImages()
    {
        $info=upload($_FILES['imgFile'],$path);
        $tmp="/Uploads/".$info['savepath'].$info['savename'];

        /*$targetDir = 'upload_tmp';
        $uploadDir = 'upload';

        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds


        // Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

        // Create target dir
        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir);
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;

        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;


        // Remove old temp files
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }


        // Open temp file
        if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");

        $index = 0;
        $done = true;
        for( $index = 0; $index < $chunks; $index++ ) {
            if ( !file_exists("{$filePath}_{$index}.part") ) {
                $done = false;
                break;
            }
        }
        if ( $done ) {
            if (!$out = @fopen($uploadPath, "wb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }

            if ( flock($out, LOCK_EX) ) {
                for( $index = 0; $index < $chunks; $index++ ) {
                    if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
                        break;
                    }

                    while ($buff = fread($in, 4096)) {
                        fwrite($out, $buff);
                    }

                    @fclose($in);
                    @unlink("{$filePath}_{$index}.part");
                }

                flock($out, LOCK_UN);
            }
            @fclose($out);
        }

        // Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');*/
    }
    //公共删除
        public function comDel(){
            $tableName=I("post.tableName");
            $id=I("post.id");
            $db=M($tableName);
            $where['id']=array("in",rtrim($id,","));
            /*  删除带图片的
             * 没有图片会报错:)
             *  后来用try catch抛出异常
             */
            $info=delImg($tableName,$where);
            if ($tableName=="series") {
                $info[]=delImg($tableName,$where,"logo");
            }

            //不要先删字段。。。。
            $b=$db->where($where)->delete();
            $status=getReturn($b);
            if($tableName=="order"){
                $db1=M("cart");
                $db1->where($where)->delete();
            }
            $status["delete"]=$info;
            //  返回值
            $this->ajaxReturn($status);

        }

}