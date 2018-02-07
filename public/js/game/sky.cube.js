VSong.sky = {
	loadImage:function(url, callback){
		var img = new Image();
		img.src = url;
		img.onload = callback;
	},
    cube:function(url,callback) {
        if (!url) return;
		var obj = {
            metadata:{
                version:4.5,
                type:"Object",
                generator:"Object3D.toJSON"
            },
            geometries:[ {
                uuid:"BAF6358E-F3E4-4361-A10D-6F21C9369A9A",
                type:"Geometry",
                name:"skyCubeGeometry",
                data:{
                    vertices:[ 1, -1, 1, 1, 1, 1, 1, -1, -1, 1, 1, -1, -1, -1, 1, -1, 1, 1, -1, -1, -1, -1, 1, -1 ],
                    normals:[ -1, 0, 0, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, -1, 0, 0, -1, 0, 1, 0, 0, 1, 0, 0, -1, 0, 0, -1, 0 ],
                    uvs:[ [ 1, 0, 1, .5, .666667, 0, .666667, .5, .333333, 0, .333333, .5, 0, 0, 0, .5, .666667, 1, 1, 1, 0, .5, 0, 1, .333333, 1 ] ],
                    faces:[ 58, 0, 1, 2, 0, 0, 1, 2, 0, 0, 0, 0, 58, 1, 3, 2, 0, 1, 3, 2, 0, 0, 0, 0, 58, 2, 3, 6, 0, 2, 3, 4, 1, 2, 2, 2, 58, 3, 7, 6, 0, 3, 5, 4, 1, 2, 2, 2, 58, 6, 7, 4, 0, 4, 5, 6, 3, 3, 3, 3, 58, 7, 5, 4, 0, 5, 7, 6, 3, 3, 3, 3, 58, 1, 0, 5, 0, 8, 3, 9, 4, 5, 5, 5, 58, 0, 4, 5, 0, 3, 1, 9, 4, 5, 5, 5, 58, 4, 0, 6, 0, 10, 5, 11, 6, 7, 7, 7, 58, 0, 2, 6, 0, 5, 12, 11, 6, 7, 7, 7, 58, 7, 3, 5, 0, 5, 3, 12, 8, 9, 9, 9, 58, 3, 1, 5, 0, 3, 8, 12, 8, 9, 9, 9 ]
                }
            } ],
            materials:[ {
                uuid:"50096CB9-78DD-40A9-AFD3-41981DFF2179",
                type:"MeshStandardMaterial",
                name:"skyCubeMaterial",
                color:16777215,
                roughness:1,
                metalness:0,
                emissive:0,
                map:"98227D5D-2590-475B-BC9C-7D5CC4E976D6",
                depthFunc:3,
                depthTest:true,
                depthWrite:true
            } ],
            textures:[ {
                uuid:"98227D5D-2590-475B-BC9C-7D5CC4E976D6",
                name:"",
                mapping:300,
                repeat:[ 1, 1 ],
                offset:[ 0, 0 ],
                wrap:[ 1001, 1001 ],
                minFilter:1008,
                magFilter:1006,
                anisotropy:1,
                flipY:true,
                image:"581346E4-C7CC-4B87-B870-1E91BA85146F"
            } ],
            images:[ {
                uuid:"581346E4-C7CC-4B87-B870-1E91BA85146F",
                url:url
            } ],
            object:{
                uuid:"CA4775BF-9C9C-4F5D-9C25-3358CDA945A6",
                type:"Mesh",
                name:"skyCubeObject",
                matrix:[ 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1 ],
                geometry:"BAF6358E-F3E4-4361-A10D-6F21C9369A9A",
                material:"50096CB9-78DD-40A9-AFD3-41981DFF2179"
            }
        };
        this.loadImage(url, function(){
			callback && callback(obj);
		});
    }
};