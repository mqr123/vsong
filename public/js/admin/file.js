var inputFile = document.getElementsByClassName('files')[0];
var ul = document.getElementsByTagName('ul')[0];
var btn = document.getElementsByClassName('submit')[0];
var progress;
var fileData = [];
var flag = true;

inputFile.onchange = function() {
	flag = true;
	btn.classList.add('wait');
	progress = {value:0,max:this.files.length};
	if(this.files.length>5){
		alert('文件数量超出，最多上传5张图片');
		return;
	}		
	for(var i = 0; i < this.files.length; i++){
		if(flag)readers(this.files,i);
	}
}
//文件去重
function fileExists(key){
	var isExists = false;
	fileData.forEach(function(f){
		if(f.name + f.lastModified === key)isExists = true;
	});
	return isExists;
}
//文件异步读取
function readers(files, index){
	var reader = new FileReader();
	var file = files[index];
	reader.readAsDataURL(file);
	if(['image/png','image/jpeg','image/jpg','image/gif'].indexOf(file.type)==-1){
		alert('文件类型只允许：png、jpg、gif');
		return;
	}
	if(file.size > 2048*1024){
		alert('文件大小超出限制，最大允许 2 MB');
		return;
	}
	if(fileExists(file.name + file.lastModified)){
		alert('文件重复('+file.name+')');
		return;
	}
	if(fileData.length>=5){
		alert('文件数量超出，最多上传5张图片');
		flag = false;
		return;
	}
	reader.onload = function(e){
		file.result = e.target.result;
		fileData.push(file);
		progress.value+=1;
		var img = new Image();
		img.src = e.target.result;	
		var li = document.createElement('li');
		var i = document.createElement('i');
		i.classList = 'deleteBtn';
		li.appendChild(img);
		li.appendChild(i);
		ul.appendChild(li);
		li.key = file.name + file.lastModified;
		i.addEventListener('click',function(){
			var _i = this;
			ul.removeChild(this.parentNode);
			fileData.forEach(function(f,index){
				if(f.name + f.lastModified == _i.parentNode.key)fileData.splice(index,1);
			});
		});
		//上传进度
		if(progress.value>=progress.max){
			btn.classList.remove('wait');
			console.log('文件读取完成！',fileData.length);
		}
	}
	reader.onerror = function(){
		alert('上传失败');
	}
}
