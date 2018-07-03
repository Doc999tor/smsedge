export function getLogRequestQueryString (paramsObject) {
	console.log(paramsObject)
	return '?' + Object.keys(paramsObject)
		.filter(k => paramsObject[k])
		.map(k => `${k}=${paramsObject[k]}`).join('&');
}