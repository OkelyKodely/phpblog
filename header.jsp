<head>
<title>JSPBLOG</title>
<link href="bootstrap.min.css" rel="stylesheet" />
</head>

<body>
<nav class="navbar navbar-inverse" style="background-color: red">
	<div class="container">
		<div class="navbar-header">
                    <%
                        String uid = "";
                        if(session.getAttribute("userid") != null)
                            uid = (String) session.getAttribute("userid");
                        else if(request.getParameter("userid") != null)
                            uid = request.getParameter("userid");
                        
                        if(!uid.equals("")) {
                        %>
			<a class="navbar-brand" style="color:black;background-color: red" href="index.jsp"><%=uid%>'s blog</a>
                        <%
                        } else {
                        %>
			<a class="navbar-brand" style="color:black;background-color: red" href="index.jsp">JSPBLOG</a>
                        <%
                        }
                        %>
		</div>
		<div id="navbar" style="background-color: red">
			<ul class="nav navbar-nav navbar-right" style="background-color: red">
				<%
                                if(session.getAttribute("userid") == null) {
				%>
				<li style="background-color: red"><a style="color:black;" href="login.jsp">Sign in</a></li>
				<li style="background-color: red"><a style="color:black;" href="register.jsp">Sign up</a></li>
				<%
                                } else {
				%>
				<li class="active" style="background-color:red">
					<div class="navbar-brand" style="color:black;background-color: red">
						<a style="color:black;" href="login.jsp">Manage blog</a>
						|&nbsp;<a style="color:black;" href="logout.jsp">Sign out</a>
					</div>
			  </li>
				<%
				}
				%>
			</ul>
		</div>
	</div>
</nav>