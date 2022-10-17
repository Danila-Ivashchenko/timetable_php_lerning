function clean_spaces(line){
	let new_line = ""
	let c = ' '
	for (const f_c of line){
		if (c != ' ' || f_c != ' ')
			new_line += f_c
		c = f_c
	}
	return String(new_line)
}

function validate(form){
	fail = validateFirstname(form.firstname.value)
	fail += validateSername(form.sername.value)
	fail += validateLogin(form.login.value)
	fail += validatePassword(form.password.value)
	if (fail == "") return true
	else { alert(fail); return false }
}

function validateFirstname(field){
	field = clean_spaces(field)
	return (field != "" && field != "None" && field != "Undefiend") ? "" : "Неверно введено имя.\n"
}
function validateSername(field){
	field = clean_spaces(field)
	return (field != "" && field != "None" && field != "Undefiend") ? "" : "Неверно введена фамилия.\n"
}
function validateLogin(field){
	field = clean_spaces(field)
	if (!(field != "" && field != "None" && field != "Undefiend")) 
		return "Неверно введен логин.\n"
	else if (field.length < 5) 
		return "Логин должен быть не короче 5 символов.\n"
	else if (/[^a-zA-Z0-9_-]/.test(field))
		return "Логин должен содержать латинские буквы, цыфры или '-'.\n"
	return ""
}
function validatePassword(field){
	field = clean_spaces(field)
	if (!(field != "" && field != "None" && field != "Undefiend")) return "Неверно введен пароль.\n"
	if (field.length < 5) return "Пароль должен быть не короче 5 символов.\n"
	if (!/[a-zA-Z]/.test(field) || !/[0-9]/.test(field) ) return "Пароль должен содержать латинские буквы и цыфры.\n"
	return ""
}