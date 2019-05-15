{{-- contenido del email welcome --}}
<table  style='background-color:#f1f1f1;min-width:600px' width='100%' bgcolor='#f1f1f1'>
<tr>
    <td style='min-width:600px' width='100%' valign='top' align='center'>
    <table bgcolor='#f1f1f1'> 
        <tr>
        <td align='center'>
            <table style='min-width:600px'  width='100%' cellspacing='0' cellpadding='0' border='0'>
            
            <tr height='50'>
                <td style='line-height:1px;font-size:1px' width='100%' height='50'>&nbsp;</td>
            </tr>
            <tr>
                <td align='center'>
                <table style='min-width:600px' cellspacing='0' cellpadding='0' border='0'>
                    <tr>
                    <td align='center'>
                        <div  style='max-height:50px'>
                            <a><img alt='sportsOn' src='https://sportsoncol.000webhostapp.com/img/ppp.png' style='max-width:auto;height:auto' title='SportsOn' width='250px'>
                            </a>
                        </div>
                    </td>
                    </tr>
                </table><!-- imagen tables -->
                </td>
            </tr>
            </table>
            <table style='min-width:600px'  width='100%' cellspacing='0' cellpadding='0' border='0'>
            <tr height='50'>
                <td style='line-height:1px;font-size:1px' width='100%' height='50'>&nbsp;</td>
            </tr><!-- espacio -->
            <tr>
                <td align='center'>
                <div style='font-family:arial,Helvetica Neue,sans-serif;font-weight:bold;font-size:50px;color:#313131;text-align:center;line-height:75px'>
                    Welcome
                </div>
                </td>
            </tr><!-- title -->
            <tr height='30'>
                <td style='line-height:1px;font-size:1px' width='100%' height='30'>&nbsp;</td>
            </tr><!-- espacio -->
            </table><!-- title table -->
            
        </td>
        </tr>
    </table>
    <!-- imagen y titulo --> 
    <table bgcolor='#f1f1f1'>
        <tr>
        <td align='center'>
            <table style='min-width:600px;background-color:#ffffff' width='600' border='0' bgcolor='#ffffff'>
            <tr height='30'>
                <td style='line-height:1px;font-size:1px' width='100%' height='30'>&nbsp;</td>
            </tr><!-- espacio -->
            <tr>
                <td style='font-family:arial,helvetica,sans-serif;font-size:16px;color:#313131;text-align:left;line-height:24px' align='center'>
                <div style='font-family:arial,helvetica,sans-serif;font-size:16px;color:#313131;text-align:center;line-height:24px'>
                <span style='font-size:18px'><strong>Saludos, {{$userdata->name}}</strong></span><br>
                    <br>
                    {{-- Se ha cambiado con éxito la contraseña. Si no has realizado esta solicitud, 
                    ponte en contacto con nosotros inmediatamente. --}}
                    bienvenidos a SportsOnApp
                    <br>
                    {{-- Contraseña:  {{$userdata['password']}} --}}
                    <br>
                    <br>
                </div>
                </td>
            </tr>
            <tr height='30'>
                <td style='line-height:1px;font-size:1px' width='100%' height='30'>&nbsp;</td>
            </tr>
            </table>
        </td>
        </tr>
    </table>
    <!-- footer mail --> 
    <table style='min-width:600px' width='600' cellspacing='0' cellpadding='0' border='0'>
        <td align='center'>
        <div style='font-family:ariel,helvetica,sans-serif;font-weight:bold;font-size:14px;color:#313131;text-align:center;line-height:26px'>
            comunícate con nosotros
            <p style='text-decoration:none;color:#17a2c5' target='_blank'>
            sportsoncol@<span class='il'>gmail</span>.com
            </p>
            <br>
        </div>
        </td> 
        <tr height='20'>
        <td style='line-height:1px;font-size:1px' width='100%' height='20'>&nbsp;</td>
        </tr>
        <tr>
        <td align='center'>
            <div style='font-family:ariel,helvetica,sans-serif;font-size:12px;color:#858585;text-align:center;line-height:20px'>
            <p>© 2018, <span class='il'>SportsOnCol</span>, Inc. All rights reserved. </p>
            <a href='#' style='color:#17a2c5' target='_blank'>Terms of Service</a> | <a style='color:#17a2c5' href='#'>Privacy Policy</a>
            </div>
        </td>
        </tr>
        <tr height='20'>
        <td style='line-height:1px;font-size:1px' width='100%' height='20'>&nbsp;</td>
        </tr>
    </table>
    </center>
    </td>
</tr>

</table>