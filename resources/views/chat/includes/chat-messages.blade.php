<ul class="chat">
    <li class="left clearfix" v-for="message in messages" :key="message.id">
        <div class="clearfix">
            <div class="header">
                <strong>

                </strong>
            </div>
            <p>

            </p>
        </div>
    </li>
</ul>
<script>
    export default {
        props: ["messages"],
    };


</script>
