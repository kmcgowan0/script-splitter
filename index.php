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
<style>
body {
font-family: sans-serif;
text-align: center;
}
textarea {
    width: 80%;
    height: 200px;
}
.hidden-content {
    display: none;
}
table {
    width:80%; 
    margin-left: auto; 
    margin-right: auto;
    
}
.result {
    margin-top: 3em;
}
table tr:nth-child(even) {
    background-color: #eee;
}
table tr:nth-child(odd) {
    background-color: #fff;
}
.teaser-div {
    display: flex;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
}
.copy-this {
        border-color: rgb(216, 216, 216) rgb(209, 209, 209) rgb(186, 186, 186);
    border-style: solid;
    border-width: 1px;
    padding: 1px 7px 2px;
}
.a-section {
    margin: 2em;
}
input[type='submit'] {
    display: block;
    width: 20%;
    margin-left:auto;
    margin-right:auto;
    margin-top: 1em;
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
    <td style="background-color: #fff;"><button class="copy-this" onclick="copyToClipboard(document.getElementById('section-<?php echo $sectionCount; ?>'));">Copy Section <?php echo $sectionCount; ?></button></td> 
  </tr>

<div id="section-<?php echo $sectionCount; ?>" class="hidden-content"><?php echo $section; ?></div>

    <?php 
    $sectionCount++;
} ?>
</table>
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