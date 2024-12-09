var format = [
	["tommorow", "tommorow, H:i:s"],
	["s" , "sago"],
	["H", "Hago, iago"],
	["d", "dago"],
	["m100", "mago"],
	["m", "mago"],
	["-", "mago"]
];
console.log(BX.date.format(format, new Date(2024,10,30,9,58,0,0)));
console.log(new Date());

console.log(BX.message("FORMAT_DATE"));
console.log(BX.message("FORMAT_DATETIME"));

console.log(BX.date.convertBitrixFormat("H.i.s"));


