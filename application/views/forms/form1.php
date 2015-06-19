<?php
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 6/19/15
 * Time: 11:08 AM
 */
?>
<table border="0" width="100%">
    <tr>
        <td colspan="2"><table border="0" width="100%">
                <tbody>
                <tr>
                    <td><p><u>1.0 Cover Page</u></p>
                        <p>Complete the following fields to create the cover page of your plan:</p></td>
                </tr>
                </tbody>
            </table></td>
    </tr>
    <tr>
        <td width="18%">Title of the plan:</td>
        <td width="82%"><input type="text" name="txttitle" id="txttitle"/></td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td>Date:</td>
        <td><input type="text" id="datepicker" class="datePickerWidget"/></td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">The school(s) covered by the plan:</td>
    </tr>
    <tr>
        <td colspan="2"><textarea name="textareaplan" id="textareaplan" style="width: 100%" rows="11"></textarea></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"><p><u>1.1 Promulgation Document and Signatures</u>            </p>            <p>This document or page contains a signed statement formally recognizing and adopting the school EOP. It gives both the authority and the responsibility to school officials to perform their tasks before, during, or after an incident, and therefore should be signed by the school administrator or another authorizing official.</p></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the field below, please cut and paste or write out the Promulgation Document and Signatures section of your school EOP.</strong></td>
    </tr>
    <tr>
        <td colspan="2"><textarea name="textareaq1" id="textareaq1" style="width: 100%" rows="11"></textarea></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"><p><u>1.2 Approval and Implementation</u>            </p>            <p>The Approval and Implementation page introduces the plan, outlines its applicability, and indicates that it supersedes all previous plans. It includes a delegation of authority for specific modifications that can be made to the plan and by whom they can be made without the school administrator&rsquo;s signature. It also includes a date and should be signed by the authorized school administrator.</p></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the field below, please cut and paste or write out your school&rsquo;s or district&rsquo;s statement formally recognizing and adopting the school EOP.</strong></td>
    </tr>
    <tr>
        <td colspan="2"><textarea name="textareaq2" id="textareaq2" style="width: 100%" rows="11"></textarea></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"><p><u>1.3 Record of Changes</u>            </p>            <p>Each update or change to the plan should be tracked. The Record of Changes page, usually in table format, contains—at a minimum—a change number, the date of the change, the name of the person who made the change, and a summary of the change.</p></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the table below, please identify any Record of Changes information, as described above. If your plan does not yet contain any changes, you may leave the material included below untouched. Also, if you prefer to organize your Record of Changes information using different headings, or in a different format, you may edit the material located in the field below.</strong></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><div align="center"><strong>Record of Changes</strong></div></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <div style="text-align: right">
                <a href="#.php" id="addRowsQ3Link">Add Row</a>
                |
                <a href="#.php" id="removeRowsQ3Link">Remove Row</a>
            </div>
            <table border="0" width="100%">
                <tr style="background: #eee">
                    <td><strong>Change Number</strong></td>
                    <td><strong>Date of Change</strong></td>
                    <td><strong>Name</strong></td>
                    <td><strong>Summary of Change</strong></td>
                </tr>
                <tr id="thRowQ31" class="thInputRowQ3">
                    <td><input type="text" name="txtrowq311" id="txtrowq311" /></td>
                    <td><input type="text" name="txtrowq312" id="txtrowq312" class="datePickerWidget"/></td>
                    <td><input type="text" name="txtrowq313" id="txtrowq313" /></td>
                    <td><input type="text" name="txtrowq314" id="txtrowq314" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"><p><u>1.4 Record of Distribution</u>          </p>
            <p>Districts and schools typically share their final EOPs with community partners who have a role in carrying out the plan before, during, or after an emergency. The record of distribution, usually in table format, documents the title and the name of the person receiving the plan, the agency to which the recipient belongs (either the school office or, if from outside the school, the name of the appropriate government agency or private-sector entity), the date of delivery, and the number of copies delivered.</p></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the table below, please identify any Record of Distribution information, as described above. If you have not yet distributed your plan, you may leave the material included below untouched. Also, if you prefer to organize your Record of Distribution information using different headings, or in a different format, you may edit the material located in the field below.</strong></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><div align="center"><strong>Record of Distribution</strong></div></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <div style="text-align: right">
                <a href="#.php" id="addRowsQ4Link">Add Row</a>
                |
                <a href="#.php" id="removeRowsQ4Link">Remove Row</a>
            </div>
            <table border="0" width="100%">
                <tr style="background: #eee">
                    <td><strong>Title and name of person receiving the plan</strong></td>
                    <td><strong>Agency (school office, government agency, or private-sector entity)</strong></td>
                    <td><strong>Date of delivery</strong></td>
                    <td><strong>Number of copies delivered</strong></td>
                </tr>
                <tr id="thRowQ41" class="thInputRowQ4">
                    <td><input type="text" name="txtrowq411" id="txtrowq411" /></td>
                    <td><input type="text" name="txtrowq412" id="txtrowq412" /></td>
                    <td><input type="text" name="txtrowq413" id="txtrowq413" class="datePickerWidget"/></td>
                    <td><input type="text" name="txtrowq414" id="txtrowq414" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <input type="button" value="Save" id="btnsaveform1"/>
        </td>
    </tr>
</table>