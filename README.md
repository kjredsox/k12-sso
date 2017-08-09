


<div class="tablenoborder">
<table id="topic_kcd_pdj_zj__table_1kg_xfj_zj" class="table" border="1" summary="" frame="border" rules="all" cellspacing="0" cellpadding="4"><caption><span class="tablecap"><span class="table--title-label">Table 1. </span>Supported attributes</span></caption><colgroup><col style="width: 17.808219178082194%;"><col style="width: 13.698630136986301%;"><col style="width: 68.4931506849315%;"></colgroup>
<thead class="thead" style="text-align: left;">
<tr class="row">
<th id="d51e280" class="entry nocellnorowborder">Attribute</th>
<th id="d51e283" class="entry nocellnorowborder">Mandatory</th>
<th id="d51e286" class="entry cell-norowborder">Description</th>
</tr>
</thead>
<tbody class="tbody">
<tr class="row">
<td class="entry nocellnorowborder" headers="d51e280 ">iat</td>
<td class="entry nocellnorowborder" headers="d51e283 ">Yes</td>
<td class="entry cell-norowborder" headers="d51e286 ">Issued At. The time the token was generated, this is used to help ensure that a given token gets used shortly after it's generated. The value must be the number of seconds since <a class="xref" href="http://en.wikipedia.org/wiki/Unix_time#Encoding_time_as_a_number" target="_blank" rel="noopener noreferrer">UNIX epoch</a>. Zendesk allows up to two minutes clock skew, so make sure to configure NNTP or similar on your servers.</td>
</tr>
<tr class="row">
<td class="entry nocellnorowborder" headers="d51e280 ">jti</td>
<td class="entry nocellnorowborder" headers="d51e283 ">Yes</td>
<td class="entry cell-norowborder" headers="d51e286 ">JSON Web Token ID. A unique id for the token, used by Zendesk to prevent token replay attacks.</td>
</tr>
<tr class="row">
<td class="entry nocellnorowborder" headers="d51e280 ">email</td>
<td class="entry nocellnorowborder" headers="d51e283 ">Yes</td>
<td class="entry cell-norowborder" headers="d51e286 ">Email of the user being signed in, used to uniquely identify the user record in Zendesk Support.</td>
</tr>
<tr class="row">
<td class="entry nocellnorowborder" headers="d51e280 ">name</td>
<td class="entry nocellnorowborder" headers="d51e283 ">Yes</td>
<td class="entry cell-norowborder" headers="d51e286 ">The name of this user. The user in Zendesk Support will be created or updated in accordance with this.</td>
</tr>
<tr class="row">
<td class="entry nocellnorowborder" headers="d51e280 ">external_id</td>
<td class="entry nocellnorowborder" headers="d51e283 ">No</td>
<td class="entry cell-norowborder" headers="d51e286 ">If your users are uniquely identified by something other than an email address, and their email addresses are subject to change, send the unique id from your system. Specify the id as a string.</td>
</tr>
<tr class="row">
<td class="entry nocellnorowborder" headers="d51e280 ">locale (for end-users)
<p class="p">locale_id (for agents)</p>
</td>
<td class="entry nocellnorowborder" headers="d51e283 ">No</td>
<td class="entry cell-norowborder" headers="d51e286 ">The locale in Zendesk Support, specified as a number.</td>
</tr>
<tr class="row">
<td class="entry nocellnorowborder" headers="d51e280 ">organization</td>
<td class="entry nocellnorowborder" headers="d51e283 ">No</td>
<td class="entry cell-norowborder" headers="d51e286 ">The name of an organization to add the user to.</td>
</tr>
<tr class="row">
<td class="entry nocellnorowborder" headers="d51e280 ">organization_id</td>
<td class="entry nocellnorowborder" headers="d51e283 ">No</td>
<td class="entry cell-norowborder" headers="d51e286 ">The organization's <a class="xref" href="http://developer.zendesk.com/documentation/rest_api/organizations.html" target="_blank" rel="noopener noreferrer">external ID</a> in the Zendesk API. If both organization and organization_id are supplied, organization is ignored.</td>
</tr>
<tr class="row">
<td class="entry nocellnorowborder" headers="d51e280 ">phone</td>
<td class="entry nocellnorowborder" headers="d51e283 ">No</td>
<td class="entry cell-norowborder" headers="d51e286 ">A phone number, specified as a string.</td>
</tr>
<tr class="row">
<td class="entry nocellnorowborder" headers="d51e280 ">tags</td>
<td class="entry nocellnorowborder" headers="d51e283 ">No</td>
<td class="entry cell-norowborder" headers="d51e286 ">This is a JSON array of tags to set on the user. These tags will <em class="ph i">replace</em> any other tags that may exist in the user's profile.</td>
</tr>
<tr class="row">
<td class="entry nocellnorowborder" headers="d51e280 ">remote_photo_url</td>
<td class="entry nocellnorowborder" headers="d51e283 ">No</td>
<td class="entry cell-norowborder" headers="d51e286 ">URL for a photo to set on the user profile.</td>
</tr>
<tr class="row">
<td class="entry nocellnorowborder" headers="d51e280 ">role</td>
<td class="entry nocellnorowborder" headers="d51e283 ">No</td>
<td class="entry cell-norowborder" headers="d51e286 ">The user's role. Can be set to "user", "agent", or "admin". Default is "user". If the user's role is different than it is in Zendesk Support, the role is changed in Zendesk Support.</td>
</tr>
<tr class="row">
<td class="entry nocellnorowborder" headers="d51e280 ">custom_role_id</td>
<td class="entry nocellnorowborder" headers="d51e283 ">No</td>
<td class="entry cell-norowborder" headers="d51e286 ">Applicable only if the role of the user is agent.</td>
</tr>
<tr class="row">
<td class="entry row-nocellborder" headers="d51e280 ">user_fields</td>
<td class="entry row-nocellborder" headers="d51e283 ">No</td>
<td class="entry cellrowborder" headers="d51e286 ">
<p class="p">A JSON hash of custom user field key and values to set on the user. The custom user field must exist in order to set the field value. Each custom user field is identified by its field key found in the user fields admin settings. The format of date values is yyyy-mm-dd.</p>
<div class="p">If a custom user field key or value is invalid, updating the field will fail silently and the user will still log in successfully. For more information about custom user fields, see <a class="xref" href="/hc/en-us/articles/203662066" target="_blank" rel="noopener noreferrer">Adding custom fields to users</a>.
<div class="note note"><span class="notetitle">Note:</span> Sending null values in the the user_fields attribute will remove any existing values in the corresponding fields.</div>
</div>
</td>
</tr>
</tbody>
</table>
</div>