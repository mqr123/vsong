var renderer, scene, camera, stats, controls;
var loader = new THREE.FileLoader();
var mesh, texture, playing = false;
var axisHelper, helper, anisotropy;
var body = document.body;
var speed = 0.1;
function init() {
    scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2(13421772, .002);
    camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, .1, 1e4);
    camera.position.z = 2;
    camera.position.y = .3;
    renderer = new THREE.WebGLRenderer({
        alpha:true,
        antialias:true
    });
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.gammaInput = true;
    renderer.gammaOutput = true;
    renderer.shadowMap.enabled = true;
    renderer.setSize(window.innerWidth, window.innerHeight);
	anisotropy = renderer.capabilities.getMaxAnisotropy();
	
    body.appendChild(renderer.domElement);
    window.addEventListener("resize", function() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });
    var light = new THREE.PointLight(16777215);
    light.shadow = true;
    light.position.y = 20;
    scene.add(light);
    var light = new THREE.AmbientLight(4473924);
    scene.add(light);
    stats = new THREE.Stats();
	stats.dom.classList.add('stats');
    body.appendChild(stats.dom);
    controls = new THREE.OrbitControls(camera, renderer.domElement);
    //controls.addEventListener('change',render);
    helpers(10, 10);
    animate();
}

function render() {
    if (playing && mesh && mesh.mixer) {
        mesh.mixer.update(speed);
    }
    renderer.render(scene, camera);
}

function animate() {
    requestAnimationFrame(animate);
    controls.update();
    stats.update();
    render();
}

init();

var playBtn = doms("#play", 0);

playBtn.addEventListener("click", togglePlay);

var helpBtn = doms("#helps", 0);

helpBtn.addEventListener("click", toggleHelps);

doms("#next", 0).addEventListener("click", function() {
    togglePlay(false);
    mesh.mixer.update(speed);
});

doms("#texture-file", 0).addEventListener("change", function() {
    if (this.files.length == 0) return;
    var read = new FileReader();
    read.addEventListener("load", function(e) {
        var textureLoader = new THREE.TextureLoader();
        texture = textureLoader.load(e.target.result);
		//texture.anisotropy = anisotropy;
        if (mesh) {
			if(mesh.type === 'Group'){
				setGroupMeshMaterial(mesh.children,texture);
			}else{
				var mtl;
				if(!mesh.material || (mesh.material.forEach && texture)){
					mtl = new THREE.MeshLambertMaterial({color:12105912,map:texture});
				}else if(texture){
					mtl = mesh.material.clone();
					mtl.map = texture;
				}
				mesh.material = mtl;
				if(mesh.type === 'SkinnedMesh'){
					mesh.material.skinning = true;
				}
				
			}
        }
        textureLoader = null;
    });
    read.readAsDataURL(this.files[0]);
});
/*
doms("#texture-mtl", 0).addEventListener("change", function() {
    if (this.files.length == 0) return;
	var read = new FileReader();
	var file = this.files[0];
	read.addEventListener("load", function(e) {
		var loads = new THREE.MTLLoader();
		loads.load(e.target.result,function(mtl){
			console.log(mtl);
		});
	});
	read.addEventListener("error",function(){
		console.log('reader.error');
		read = null;
	});
	read.readAsDataURL(file);
	
});
*/
doms("#geometry-file", 0).addEventListener("change", function() {
    if (this.files.length == 0) return;
	var read = new FileReader();
	var file = this.files[0];
	read.addEventListener("load", function(e) {
		if (file.type == 'application/json' || file.name.lastIndexOf(".json") != -1) {
			loader.load(e.target.result, function(text) {
				var data = JSON.parse(text);
				if(data.metadata){
					if(data.metadata.type === 'Object'){
						if(mesh)scene.remove(mesh);
						var loads = new THREE.ObjectLoader();
						mesh = loads.parse(data);
						scene.add(mesh);
					}else if(data.metadata.type === "Geometry"){
						var loads = new THREE.JSONLoader();
						//data.materials.forEach(function(mtl){});
	
						data = loads.parse(data);
						loadGeometry(data);
					}else{
						alert('暂不支持该类型（'+data.metadata.type+'）');
					}
				}
				text = data = null;
			},null,function(e){
				console.log('loadJSON.error',e);
			});
			file = read = null;
		}else if(file.type == 'application/obj' || file.name.lastIndexOf(".obj") != -1){
			loadOBJ(e.target.result);
		}else{
			alert('暂不支持该格式');
		}
	});
	read.addEventListener("error",function(){
		console.log('reader.error');
		read = null;
	});
	read.readAsDataURL(file);
	body.classList.remove("mesh");
});
function setGroupMeshMaterial(arr,texture){
	arr.forEach(function(m){
		if(m.type == 'Group'){
			setGroupMeshMaterial(m.children, texture);
		}else if(m.material){
			var mtl = m.material.clone();
			mtl.map = texture;
			m.material = mtl;
		}
	});
}
function loadOBJ(file){
	var loads = new THREE.OBJLoader();
	loads.load(file,function(data){
		if(mesh)scene.remove(mesh);
		mesh = data;
		scene.add(mesh);
	},null,function(){
		console.log('loadOBJ.error');
	});
}
function loadGeometry(data) {
	if (mesh)scene.remove(mesh);
	if (!data.materials || data.materials.length==0)data.materials = [ new THREE.MeshLambertMaterial({color:12105912})];
	if (data.geometry.animations !== undefined && data.geometry.animations.length > 0){
		
		data.materials.forEach(function(mtl){
			mtl.skinning = true;
		});
		//data.materials[0].skinning = true;
		mesh = new THREE.SkinnedMesh(data.geometry, data.materials, false);
		mesh.mixer = new THREE.AnimationMixer(this.scene);
		
		mesh.mixer.clipAction(mesh.geometry.animations[0], mesh).setDuration(10).startAt(1).play();
		
		body.classList.add("mixer");
	} else {
		mesh = new THREE.Mesh(data.geometry, data.materials[0]);
		body.classList.remove("mixer");
	}
	if (texture) data.materials[0].map = texture;
	mesh.castShadow = true;
	mesh.receiveShadow = true;
	mesh.name = "monster";
	scene.add(mesh);
	body.classList.add("mesh");
	togglePlay(true);
	data = null;

}

function togglePlay(always) {
    if (!body.classList.contains("mixer")) return;
    if (always === false || playing) {
        playing = false;
        playBtn.textContent = "播放";
    } else if (always === true || !playing) {
        playing = true;
        playBtn.textContent = "暂停";
    }
}

function toggleHelps() {
    if (!helpBtn.hide) {
        helpBtn.textContent = "显示网格";
        helpBtn.hide = true;
        helper.visible = axisHelper.visible = false;
    } else {
        helpBtn.textContent = "隐藏网格";
        helpBtn.hide = false;
        helper.visible = axisHelper.visible = true;
    }
}

function doms(slt, index) {
    slt = document.querySelectorAll(slt);
    var dom = index === null ? slt :slt[index || 0] ? slt[index || 0] :{};
    dom.change = function(callback) {
        dom.addEventListener("change", callback);
    };
    return dom;
}

function helpers(size, divisions) {
    helper = new THREE.GridHelper(size, divisions);
    axisHelper = new THREE.AxisHelper(2);
    axisHelper.position.y = .01;
    scene.add(helper);
    scene.add(axisHelper);
}

window.addEventListener("keydown", function(e) {
    if (e.keyCode == 116) return true;
    if (e.keyCode <= 123 && e.keyCode >= 112) {
        e.preventDefault();
        return false;
    }
});

window.addEventListener("contextmenu", function(e) {
    e.preventDefault();
    return false;
});

window.addEventListener("keydown", function(e) {
    switch (e.keyCode) {
      case 13:
        if (mesh.mixer) {
            togglePlay(false);
            mesh.mixer.update(speed);
        }
        ;
        break;

      case 32:
        togglePlay();
        break;

      case 27:
        togglePlay(false);
        break;

      case 72:
        toggleHelps();
        break;

      case 70:
        doms("#geometry-file", 0).click();
        break;

      case 84:
        doms("#texture-file", 0).click();
        break;
    }
});