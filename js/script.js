// //动态元素的出现
var scount = true;
var qcount = true;
var upcount = true;
var counter = true;
function logout(){
    var dcd = confirm('您是否要注销?');
    if (dcd){
        window.location = 'login.php?logout';
    }
}
function chooseall(self){
    var ck = document.getElementsByName("all[]");
    if(counter){
        for(var i = 0;i<ck.length;i++)
            ck[i].checked = true;
        counter = false;
        self.innerText = "不选";
    }else{
        for(var i = 0;i<ck.length;i++)
            ck[i].checked = false;
        counter = true;
        self.innerText="全选";
    }
}
function checkfile(file){
    // document.getElementById('filetext').innerText = document.getElementById("fileinp").value;
    if(file.files[0].name.length>30){
        alert("文件名不能超过30个字符");
        file.value="";
    }
    if(file.files[0].size/1024 >20000){
        alert("文件大小必须小于20M");
        file.value="";
    }
    document.getElementById('filetext').innerText = file.files[0].name;
}
function sapper(){        
    if (scount){
        document.getElementById("sarrow").className="iconfont icon-xiangshang";
        document.getElementById("select").style.marginTop="0px";
        scount=false;
    }else{
        document.getElementById("sarrow").className="iconfont icon-xiangxia";
        document.getElementById("select").style.marginTop="-30rem";
        scount=true;
    }
}
function upapper(){        
    if (upcount){
        document.getElementById("up_file_i").className="iconfont icon-xiangshang";
        upcount=false;
    }else{
        document.getElementById("up_file_i").className="iconfont icon-xiangxia";
        upcount=true;
    }
}
function qapper(){
    if (qcount){
        document.getElementById("file_up").style.marginLeft="40rem";
        document.getElementById("file_up").style.transform="scale(1.0)";
        qcount=false;
    }else{
        document.getElementById("file_up").style.marginLeft="-20rem";
        document.getElementById("file_up").style.transform="scale(0.0001)";
        qcount=true;
    }
}
function query(){
    var kw = prompt("请输入需要查询的文件名：");
    window.location.href = "index.php?kw="+kw;
}
function dd(name){//下载+PHP计数
    var a = document.createElement("a");
    a.download = name;
    a.href = './storage/'+name;
    a.click();
    a.remove();
    window.location ="download.php?name="+name;
}
