    <?php 
    if ($preview && $preview_id) { ?>
        <script>
            /* <![CDATA[ */
                var previewObj = {"previewId": "<?= $preview_id ?>"};
            /* ]]> */
        </script>
        <script src="/js/preview.js"></script> <?php
    } ?>
    </div>
</body>
</html>