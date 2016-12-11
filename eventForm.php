<form name='eventform' method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <table width="400px">
        <tr>
            <td width="150px">Title</td>
            <td width="250px"><input type="text" name="txttitle"></td>
        </tr>
        <tr>
            <td width="150px">Detail</td>
            <td width="250px"><textarea name="txtdetail"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" name="btnadd" value="Add Event"></td>
        </tr>
    </table>
</form>