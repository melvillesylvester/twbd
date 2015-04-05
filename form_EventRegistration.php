<script type="text/javascript" language="javascript"><!--
function validate(theForm){
	if (theForm.name.value == "")
	{
		alert("Please provide your Name.");
		theForm.name.focus();
		return (false);
	}

	emailpattern = "^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$";
	emailreg = new RegExp(emailpattern, "g");
	if (!Boolean(emailreg.exec(theForm.email.value))){
		alert("Please provide a valid email address.");
		theForm.email.focus();
		return (false);
	}

	return (true);
}
//--></script>

<form name="form1" action="RegistrationRequest_confirmation.php" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">

<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><table cellpadding="0" cellspacing="5" border="0">
	<tr>
		<td align="left" valign="top" colspan="3"><div class="form1">
	      <h3>Christ the Healer Conference <br />
and School of Healing <br /><br />

REGISTRATION FORM:</h3> 
		    <p>All <font class="required">*</font> fields are required.</p>
	    </div></td>
	</tr>
	<tr>
		<td align="left" valign="top"><div class="required">*</div></td>
		<td align="left" valign="top"><div class="form1">Name:</div></td>
		<td align="left" valign="top"><input type="text" name="name" size="20" maxlength="50" class="formElements"></td>
	</tr>
	<tr>
		<td align="left" valign="top"><div class="required">*</div></td>
		<td align="left" valign="top"><div class="form1">E-mail:</div></td>
		<td align="left" valign="top"><input type="text" name="email" size="20" maxlength="100" class="formElements"></td>
	</tr>
	<tr>
		<td align="left" valign="top"><div class="required"></div></td>
		<td align="left" valign="top"><div class="form1">Daytime Phone:</div></td>
		<td align="left" valign="top"><input type="text" name="phone" size="20" maxlength="20" class="formElements"></td>
	</tr>
	<tr>
		<td align="left" valign="top"><div class="required">*</div></td>
		<td align="left" valign="top"><div class="form1">Contact Preference:</div></td>
		<td align="left" valign="top"><div class="form1"><input type="radio" name="contactpreference" value="email" checked> Email<br>
			<input type="radio" name="contactpreference" value="Phone"> Phone<br>
			<input type="radio" name="contactpreference" value="Do_Not_Contact"> Do Not Contact</div>
		</td>
	</tr>

	<tr>
		<td align="left" valign="top"><div class="required"></div></td>
		<td align="left" valign="top"><div class="form1">Commets:</div></td>
		<td align="left" valign="top"><textarea name="comments" cols="30" rows="5" class="formElements"></textarea></td>
	</tr>
	<tr>
		<td align="left" valign="top"></td>
		<td align="left" valign="top"></td>
		<td align="left" valign="top"><input type="submit" value="Send Regsitration &#187;" class="form_submit"></td>
	</tr>
</table></td>
    <td><div align="center"><img src="/images/healer2.jpg" width="464" height="325" alt="Register" /></div></td>
  </tr>
</table>
</form>
