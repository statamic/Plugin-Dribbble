Statamic Dribbble Plugin
================================

The Dribbble plugin is used for fetching and displaying information from Dribbble's API, including players, shots, and lists.

## Installing
1. Download the zip file (or clone via git) and unzip it or clone the repo into `/_add-ons/`.
2. Ensure the folder name is `dribbble` (Github timestamps the download folder).
3. Enjoy.

## Tag Pair: *Player*

**Example Tag:**

    {{ dribbble:players player="jackmcdade" }}
      <h1><a href="{{ url }}">{{ name }}</a></h1>
      <div class="avatar"><img src="{{ avatar_url }}"></div>
      <ul>
        <li>Shots taken: {{ shots_count }}</li>
        <li>Followers: {{ followers_count }}</li>
        <li>Following: {{ following_count }}</li>
        <li>Comments Received: {{ comments_received_count }}</li>
      </ul>
      <div class="membership">Member since {{ created_at format="Y-m-d" }}</div>
    {{ /dribbble:players }}
    
### Parameters

#### Player `player`

Username of the player you wish to request.

    player="jackmcdade"

### Variables

The following single variables are available inside the `{{ dribbble:players }}` tag pair. This plugin will always return the full API request assigned as Statamic variables, so the [Dribbble API docs](http://dribbble.com/api#get_player) will always be the most up to date source of information.

- `{{ id }}`
- `{{ name }}`
- `{{ username }}`
- `{{ url }}`
- `{{ avatar_url }}`
- `{{ location }}`
- `{{ twitter_screen_name }}`
- `{{ drafted_by_player_id }}`
- `{{ shots_count }}`
- `{{ draftees_count }}`
- `{{ followers_count }}`
- `{{ following_count }}`
- `{{ comments_count }}`
- `{{ comments_received_count }}`
- `{{ likes_count }}`
- `{{ likes_received_count }}`
- `{{ rebounds_count }}`
- `{{ rebounds_received_count }}`
- `{{ created_at }}`

## Tag Pair: *:Shots*

**Example Tag**

    {{ dribbble:shots player="jackmcdade" }}
    <h1>Shots by {{ player }}{{ name }}{{ /player }}</h1>
      {{ shots }}
        <div class="shot">
          <h2><a href="{{ url }}">{{ title }}</a></h2>
          <a href="{{ short_url}}"><img src="{{ image_url }}" title="{{ title }}" /></a>
          <ul class="stats">
            <li>Views: {{ views_count }}</li>
            <li>Likes: {{ likes_count }}</li>
            <li>Comments: {{ comments_count }}</li>
            <li>Dribbbbbbbbbled on {{ created_at format="Y-m-d" }}</li>
          </ul>
        </div>
      {{ /shots }}
    {{ /dribbble:shots }}

### Parameters

#### Player `player`

Username of the player you wish to request.

    player="jackmcdade"

#### Limit `limit`
**Default:** 5

Limit the number of shots returned.

### Variables & Variable Pairs

This tag returns a lot of goodness. This plugin will always return the full API request assigned as Statamic variables, so the [Dribbble API docs](http://dribbble.com/api#get_player_shots) will always be the most up to date source of information.

*Note that this is an implementation of the `GET /players:id/shots` endpoint, and not `GET /shots/:id`, as you might assume by looking at the API docs*

#### Variable Pair: *:Player*

{{ player }} {{ /player }}

Same as the [`{{ dribbble:player }}`](#tag-pair-player) tag pair, but inside this particular request.

#### Variable Pair: *:Shots*

    {{ shots }} {{ /shots }}

- {{ id }}
- {{ title }}
- {{ url }}
- {{ short_url }}
- {{ image_url }}
- {{ image_teaser_url }}
- {{ width }}
- {{ height }}
- {{ views_count }}
- {{ likes_count }}
- {{ comments_count }}
- {{ rebounds_count }}
- {{ rebound_source_id }}
- {{ created_at }}

## Tag Pair *List*

This tag is exactly like [`{{ dribbble:shots }}`](#tag-pair-shots), except it lets you fetch from a list (such as *debuts* or *everyone*) instead of a player.

    {{ dribbble:list list="popular" }} {{ /dribbble:list }}


### Parameters

#### List `list`

*Default:* everyone

*Available Options:*
- everyone
- debut
- popular

The Dribbble list you wish you request shots from. 

    player="jackmcdade"

#### Limit `limit`
**Default:** 5
