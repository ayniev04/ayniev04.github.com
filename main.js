window.onload = function() {
	let mesForm = document.querySelectorAll('.mesForm')
	let message = document.querySelectorAll('.message')
	let user = document.querySelectorAll('.active')
	let buttons = document.querySelectorAll('.btns')
	let showMes = document.querySelectorAll('.showMes')
	let messages = document.querySelectorAll('.mes')
	let isSet = false;
	for(let i = 0; i < message.length; i++) {
		message[i].addEventListener('click', function(e) {
			if(isSet) {
				message[i].innerHTML='написать'
				mesForm[i].style.display = 'none'
				buttons[i].style.display = 'none'
				isSet = false
			}
			else {
				message[i].innerHTML='отмена'
				mesForm[i].style.display = 'block'
				buttons[i].style.display = 'block'
				isSet = true
			}
		})
	}

	let hasClicked = false
	for(let i = 0; i < showMes.length; i++) {
		showMes[i].onclick = function() {
			if(hasClicked) {
				messages[i].style.display = 'none'
				this.innerHTML = 'показать'
				hasClicked = false
			} else {
				this.innerHTML = 'скрыть'
				messages[i].style.display = 'block'
				hasClicked = true
			}
		}
	}

	let toUser = document.querySelectorAll('.toUser')
	for(let i = 0; i < toUser.length; i++) {
		toUser[i].value = toUser[i].parentNode.parentNode.getAttribute('data-name')
	}
}