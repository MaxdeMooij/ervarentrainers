<template>
  <div>
    <!--<ais-index :search-store="searchStore" :index-name="indexName" :auto-search="false">-->
    <div id="header">
      <div class="headerbox">
        <h1>Vind de ervaren trainers die bij je passen</h1>
        <div class="search-area">
          <input type="text" placeholder="Zoek een training..." class="search" v-model="query" v-on:keydown.enter="searchActive = true"/>
          <div class="search-button" v-on:click="searchActive = true">Zoeken</div>

          <div class="btn-group" role="group" aria-label="Search result type">
            <button type="button" class="btn" :class="[index == 'Training' ? 'btn-primary' : 'btn-outline-primary']" v-on:click="setIndex('Training')">Training</button>
            <button type="button" class="btn" :class="[index == 'User' ? 'btn-primary' : 'btn-outline-primary']" v-on:click="setIndex('User')">Trainers</button>
          </div>
        </div>
      </div>
    </div>
    <div class="container">

      <div class="row" v-if="searchActive">
        <div class="col-8">
          <ais-no-results>
            <template slot-scope="{ query }">
              We hebben geen trainingen gevonden voor "<i>{{ query }}"</i>.
            </template>
          </ais-no-results>
          <ais-results>
            <template slot-scope="{ result }">
              <div class="search_results">
                <div v-if="index == 'User'">
                  <h1>{{ result.firstName }}
                    {{ result.lastName }}</h1>
                  <h4>
                    <ais-highlight :result="result" attribute-name="motto"></ais-highlight>
                  </h4>
                </div>
                <div class="search_result row" v-if="index == 'Training'">
                  <a :href="'/trainers/' + result.user.slug" class="col col-md-4">
                    <div class="avatar">
                      <img class="avatar" src="">
                      <div class="trainer">
                        <span>{{ result.user.firstName }}
                          {{ result.user.lastName }}</span>
                        <span class="functie">{{ result.user.typeTrainer }}
                          {{ result.user.lastName }}</span>
                      </div>
                    </div>
                  </a>
                  <a :href="'/trainingen/' + result.slug" class="col">
                    <div class="content">
                      <h3 class="titel">{{ result.title }}</h3>
                      <p class="properties" v-if="result.prices.length[0]">
                        <span class="price">{{ result.prices[0].price }}</span>
                        <span class="timeframe">3 dagen</span>
                        <span class="type">{{ result.prices[0].type }}</span>
                      </p>
                      <p>{{ result.description }}</p>
                      <span class="tags">
                        <span v-for="tag in result.tags">{{ tag }}</span>
                      </span>
                    </div>
                  </a>
                </div>
              </div>
            </template>
          </ais-results>
        </div>
        <div class="col-4">
          <ais-stats></ais-stats>
          <div v-if="index == 'Training'">
            <ais-price-range currency="€" attribute-name="searchPrice"></ais-price-range>
          </div>
          <ais-powered-by></ais-powered-by>
        </div>
      </div>
    </div>
    <!--</ais-index>-->
  </div>
</template>

<script>
  import {createFromAlgoliaCredentials} from 'vue-instantsearch';

  export default {
    name: 'app',
    props: [
      'appId', 'apiKey', 'indexSuffix'
    ],
    data() {
      return {
        index: 'Training',
        searchStore: createFromAlgoliaCredentials(this.appId, this.apiKey)
      }
    },
    provide() {
      return {_searchStore: this.searchStore}
    },
    computed: {
      indexName() {
        return this.index + this.indexSuffix
      },
      searchActive: {
        get: function() {
          return this.searchStore._stoppedCounter === 0
        },
        set: function(newValue) {
          console.log(this.searchActive, newValue);
          if (newValue) {
            this.searchStore.start();
            this.searchStore.refresh();
          } else {
            this.searchStore.stop();
          }
        }
      },
      query: {
        get() {
          return this.searchStore.query;
        },
        set(value) {
          this.searchStore.query = value;
          this.$emit('query', value);
          // We here ensure we give the time to listeners to alter the store's state without triggering in between ghost queries.
          this.$nextTick(function() {
            this.searchStore.refresh();
          });
        }
      }
    },
    mounted() {
      this.searchStore.indexName = this.indexName;
    },
    watch: {
      indexName(val) {
        this.searchStore.indexName = val;
      }
    },
    methods: {
      setIndex(index) {
        this.index = index;
      }
    }
  }
</script>
