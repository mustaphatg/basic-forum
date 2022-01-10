


const ax = axios.create({
	baseURL : "/"
})

var num = 0
	
	function imageChoosed(){
		if(num == 4){
			alert("4 is the maximum number of image allowed.")
			return;
		}
		
		var bx = document.querySelector("#box")
		var inp = document.querySelector("#input")
		var fi = inp.files[0]
		var img = document.createElement("img")
		img.file = fi
		img.setAttribute("class", "obb")
		img.style = "border:1px solid grey; margin:3px; display:inline-block; height:90px; width:90px"
		img.src = URL.createObjectURL(fi)
		img.onload = function(){
			URL.revokeObjectURL(img.src)
		}
		bx.appendChild(img)
		num += 1
	}
	
	async function uploadImage(id, file){
		var fdd = new FormData()
		fdd.append("image", file)
		
		var a = await ax.post("post/upload_image/"+id, fdd)
		.then(re =>{
			var t = re.data.type
			
		})
		.catch(er =>{
			//alert(""+er)
			//var f = er.response.data
		})
	}
	
	
	async function createPost(){
		var showld = $("#showld") // document.querySelector("#show")
		var hide_load = document.querySelector("#hide-load")
		var bt = $("#btt") //document.querySelector("#btt")
		
		var ti = document.querySelector("#post-title").value
		var bd = document.querySelector("#post-body").value 
		var by = document.querySelector("#by").value
		var board = document.querySelector("#board").value
		
		if(ti == "" || bd == ""){
			alert("The post title and post body fields are required.")
			return;
		}
		
		bt.hide() 
		showld.removeClass("hide")
		
		
		var fd = new FormData()
		fd.append("title", ti)
		fd.append("body", bd)
		fd.append("post_by", by)
		fd.append("board", board)
		
		if(num != 0){
			fd.append("image", "yes")
		}else{
			fd.append("image", "no")
		}
		
		var a = await ax.post("/post/submit_post", fd)
		.then(res =>{
			var type = res.data.type
			
			if(type == "ok-image")
			{	
				//post id & link
				var id = res.data.id
				var lik = res.data.link
				//location.href = lik
				//upload image
				var all = document.querySelectorAll(".obb")
				all.forEach((v,i,a) =>{
					var ff = v.file
					uploadImage(id, ff)
				})
				location.href = lik
			}
			
			if(type == "ok-no-image"){
				var l = res.data.link
				location.href = l
			}
			
			if(type == "error"){
				var m = res.data.message
				//hide_load.click()
				alert(m)
				bt.show()
				showld.addClass("hide")
				
				
			}
			
		})
		.catch(er =>{
			alert(er.response.data)
			//hide_load.click()
			alert(""+er)
			bt.show()
			showld.addClass("hide")
			
		})
		
	}
	