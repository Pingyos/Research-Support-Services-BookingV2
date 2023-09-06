var ss = SpreadsheetApp.openById('1sudcQlTLFmpRzMbvFStJKT_4-N9Piz-vNh_0uelI5as')
var sheet = ss.getSheetByName('Sheet1')

function doPost(e) {
  var action = e.parameter.action
  if (action == 'addUser') {
    return addUser(e)
  }
}

function addUser(e) {
  var user = JSON.parse(e.postData.contents);
  sheet.appendRow([user.name, user.data, user.phone, user.email]);
  var response = {
    message: "success"
  };
  return ContentService.createTextOutput(JSON.stringify(response)).setMimeType(ContentService.MimeType.JSON);
}
