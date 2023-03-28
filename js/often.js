function often() {
	
	//背景紐變換監聽
	$("#bgc_btn").bind("input propertychange", function () {
		console.log($(this).is(':checked'));
		if ($(this).is(":checked")) {
			// $(this).next().text("啟用");
			// $(this).next().css("color", "green");
			// userState = "y";
			$(this).removeClass("bg-light");
			$(this).addClass("bg-dark");
			$(this).css("border-color", "var(--mycolor16)");

			$("#bgc").removeClass("bg-light");
			$("#bgc").addClass("bg-dark");
			$("#ftc").removeClass("navbar-light");
			$("#ftc").addClass("navbar-dark");


		} else {
			$(this).removeClass("bg-dark");
			$(this).addClass("bg-light");
			$(this).css("color", "var(--mycolor16)");
			$("#bgc").removeClass("bg-dark");
			$("#bgc").addClass("bg-light");
			$("#ftc").removeClass("navbar-dark");
			$("#ftc").addClass("navbar-light");
		}
	});
}

//登出按鈕監聽
$("#logout_btn").bind("click", function () {
	setCookie("UID01", "", 7);
	setCookie("UID02", "", 7);
	location.href = "Home.html";
});



