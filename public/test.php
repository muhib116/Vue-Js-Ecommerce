<script>
function reloadMe() {
	window.location.reload();
}
function getInterval(){
	var lowerBound = 30;
	var upperBound = 60;

var randNum = Math.floor((upperBound-lowerBound+1)*Math.random()+lowerBound) * 1000;
return randNum;
}
var interval = getInterval();
var srcInterval = setInterval("reloadMe()",interval);
</script>

<body>

<script type="text/javascript">
document.write ("This page will reload after "+interval/1000+" seconds");
</script>

</body>