function showMenuGeneral() {
	img = event.currentTarget;
	img.style.backgroundColor = "rgba(0, 0, 0, 0.1)";
	menu = document.createElement("div");
	menu.className = "menu";
	ul = document.createElement("ul");
	li = document.createElement("li");
	li.innerHTML = "New group";
	ul.appendChild(li);
	li = document.createElement("li");
	li.innerHTML = "Profile & status";
	ul.appendChild(li);
	li = document.createElement("li");
	li.innerHTML = "Help";
	ul.appendChild(li);
	li = document.createElement("li");
	li.innerHTML = "Log out";
	li.onclick = function () {
		location.href = "logout.php";
	}
	ul.appendChild(li);
	menu.appendChild(ul);
	offsets = event.target.getBoundingClientRect();
	event.target.parentElement.appendChild(menu);
	menu.style.top = offsets.top + 50 + "px";
	menu.style.left = offsets.left - menu.offsetWidth + 20 + "px";
	flag = false;
	hideMenu = function() {
		if (flag) {
			img.style.backgroundColor = "";
			menu.remove();
			document.body.removeEventListener("click", hideMenu);
			flag = false;
		} else {
			flag = true;
		}
	}
	document.body.addEventListener("click", hideMenu);
}

function showMenuChat() {
	img = event.currentTarget;
	img.style.backgroundColor = "rgba(0, 0, 0, 0.1)";
	menu = document.createElement("div");
	menu.className = "menu";
	ul = document.createElement("ul");
	li = document.createElement("li");
	li.innerHTML = "Contact info";
	ul.appendChild(li);
	li = document.createElement("li");
	li.innerHTML = "Delete chat";
	ul.appendChild(li);
	menu.appendChild(ul);
	offsets = event.target.getBoundingClientRect();
	event.target.parentElement.appendChild(menu);
	menu.style.top = offsets.top + 50 + "px";
	menu.style.left = offsets.left - menu.offsetWidth + 20 + "px";
	flag = false;
	hideMenu = function() {
		if (menu && flag) {
			img.style.backgroundColor = "";
			menu.remove();
			document.body.removeEventListener("click", hideMenu);
		} else {
			flag = true;
		}
	}
	document.body.addEventListener("click", hideMenu);
}
