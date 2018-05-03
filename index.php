<?php
if (isset($_POST['input-text'])) {
    $original = $_POST['input-text'];
    $sections = str_split($original, 20000);

}

?>

<!DOCTYPE html>
<html>
<head>
<title>Script Splitter</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
*{
  padding: 0;
  margin: 0;
  text-align: center;
  font-family: 'Roboto', sans-serif;
}
body{
}
.wrap{
  margin: 0 auto;
  width: 100vw;
  background: linear-gradient(135deg, #eb5454 0%, #6d8cec 100%);
  height: 100vh;
}

h1{
  padding: 1em 0;
}

.hidden-content {
    display: none;
}
textarea{
  border: 2px solid #e0e0e0;
  border-radius: 8px;
  padding: 10px;
  box-sizing: border-box;
  height: 25em;
  font-size: 14px;
  color: #979797;
  width: 80%;
  margin-bottom: 3em;
  margin-top: 3em;
  text-align: left;
}

input[type="submit"]{
  width: 40%;
  height: 3em;
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: 2.5px;
  font-weight: 500;
  color: #000;
  background-color: #fff;
  border: none;
  border-radius: 45px;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease 0s;
  cursor: pointer;
  margin-bottom: 3em;
}
input[type="submit"]:hover {
  background-color: #ff5722;
      box-shadow: 0px 15px 20px rgba(119, 29, 0, 0.73);
  color: #fff;
  transform: translateY(-3px);
}
p{
  margin-bottom: 1em;
}

.result{
  display: flex;
  flex-flow: column;
  justify-content: center;
}

table{
  width: 65%;
  text-align: center;
  margin-left: 20%;
  margin-top: 3em;
}

.copy-this{
  width: 100%;
  font-size: 11px;
  height: auto;
  text-transform: uppercase;
  letter-spacing: 2.5px;
  font-weight: 500;
  color: #000;
  background-color: #fff;
  border: none;
  border-radius: 45px;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease 0s;
  cursor: pointer;
  margin-bottom: 3em;
  padding: 5px;
}
.copy-this:hover {
  background-color: #ff5722;
      box-shadow: 0px 15px 20px rgba(119, 29, 0, 0.73);
  color: #fff;
  transform: translateY(-3px);
}
td p{
  margin-right: 10px;
}
@media only screen and (max-device-width: 375px) {
    td{
      display: block;
    }

}

</style>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118662668-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-118662668-1');
</script>

</head>
<body>
<div class="wrap">
<h1>Script Splitter</h1>
<p>This is a tool to split movie scripts (or any big chunk of text) into appropriately sized chunks to send via Facebook messenger.</p>
<p>This is a tool to torture your friends</p>
<form class="input-form" action="" method="post">
    <textarea name="input-text" placeholder="Paste your text here..."></textarea>
    <input type="submit" name="submit" value="Just fuck me up">
</form>

<?php if ($sections) { ?>
<div class="result">
<h2>Your Facebook-ready result:</h2>
<p>Click the link to copy each section</p>
    <table>

    <?php $sectionCount = 1;
    foreach ($sections as $section) {
$teaser = substr($section, 0, 100);
$teaserEnd = substr($section, -100);
        ?>
        <tr class="a-section">
    <td><p class="teaser">"<?php echo $teaser; ?>......<?php echo $teaserEnd; ?>"</p></td>
    <td><button class="copy-this" onclick="copyToClipboard(document.getElementById('section-<?php echo $sectionCount; ?>'));">Copy Section <?php echo $sectionCount; ?></button></td>
  </tr>

<div id="section-<?php echo $sectionCount; ?>" class="hidden-content"><?php echo $section; ?></div>

    <?php
    $sectionCount++;
} ?>
</table>
</div>
</div>
<?php
} ?>
<script>

function copyToClipboard(elem) {
      // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
          succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }

    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

editor.addEventListener("paste", function(elem) {
    // cancel paste
    e.preventDefault();

    // get text representation of clipboard
    var text = e.clipboardData.getData("text/plain");

    // insert text manually
    document.execCommand("insertHTML", false, text);
});
</script>
</body>
</html>
