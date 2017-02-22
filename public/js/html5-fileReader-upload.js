(function(w){
    //默认参数
    var default_option  =   {
        imagesBoxIDName : '',
        inputIDName : '',
        fileType : /image\/.*/i,
        fileSize : 5120,
        count : 5,
        init_callback : function(){
        },
        uploadFile_callback : function(){
        },
        readerFile_callback : function(){            
        },
        delboxFile_callback : function(){            
        }
    };

    w.html5uploadFile   =   {
        option : default_option,
        init : function(option){
            this.option = this.extend(this.option , option); 
            this.option.init_callback();             
        },
        uploadFile : function(){
            var files   =   document.getElementById(this.option.inputIDName).files,
            box = document.getElementById(this.option.imagesBoxIDName),
            option = this.option;
            if(files.length == 0){
                return false;
            }
            var count   =   $(box).find("div[class^='img-']").length;   
            if(count > option.count){
                alert('一次最多上传五张图片！');
                return false;
            }                  
            for(var i in files){
                var f = files[i];
                if(typeof f != 'object'){
                    continue;
                }
                if(!f.type.match(option.fileType)) {
                    alert('【'+f.name +'】 不是图片文件');
                    continue;
                }
                // alert(f.size);
                if((f.size/1024) > option.fileSize){
                    alert('【'+f.name +'】 大于 ['+option.fileSize+'kb]');
                    continue;
                }
                var reader = new FileReader();
                reader.onload = (function(file , len , b) {           
                    return function(e) {
                        var c = parseInt(len)+parseInt(count);
                        option.readerFile_callback(this , file , b , c);                       
                    };
                })(f,i,box);
                //读取文件内容
                reader.readAsDataURL(f);
            }
            document.getElementById(this.option.inputIDName).outerHTML=document.getElementById(this.option.inputIDName).outerHTML; 
        },
        extend : function (target, source) {
            for (var p in source) {
                if (source.hasOwnProperty(p)) {
                    target[p] = source[p];
                }
            }
            
            return target;
        }
    };

})(window);