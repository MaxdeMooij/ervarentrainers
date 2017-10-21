<template>
    <div>
        <ais-index :app-id="appId" :api-key="apiKey" :index-name="indexName">
            <div id="header">
                <div class="headerbox">
                    <h1>Vind de ervaren trainers die bij je passen</h1>
                    <div class="search-area">
                        <ais-input placeholder="Search users..." class="search"></ais-input>
                        <div class="search-button">Zoeken</div>
                    </div>
                </div>
            </div>
            <ais-results>
                <template slot-scope="{ result }">
                    <div class="panel">
                        <div class="panel-body">
                            <h1>{{ result.firstName }} {{ result.lastName }}</h1>
                            <h4><ais-highlight :result="result" attribute-name="motto"></ais-highlight></h4>
                        </div>
                    </div>
                </template>
            </ais-results>
        </ais-index>
    </div>
</template>

<script>
    export default {
        name: 'app',
        props: ['appId', 'apiKey', 'indexName']
    }
</script>