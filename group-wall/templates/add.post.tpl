	<DIV class="post">
			<FORM id="post-form" method="post" action="/posts/add">
				{if isset($error)}
				<DIV id="error-box"><SPAN class="error">{$error}</SPAN><BR/></DIV>
				{/if}
<LABEL for="author">Author: </LABEL><BR/>
				<INPUT id="author" name="author" type="text"/><BR/>
				<LABEL for="text">Text: </LABEL><BR/>
				<TEXTAREA id="text" name="text" rows=5></TEXTAREA><BR/>
				<INPUT id="submit" name="submit" value="Submit" type="submit"/><BR/>
			</FORM>
			<IMG src="/assets/images/ruler.png" height="2" width="400"/>
		</DIV>
	