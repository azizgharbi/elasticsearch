##show all index

`GET 192.168.33.10:9200/_cat/indices?v`

##Create an index

`PUT 192.168.33.10:9200/testindex?pretty`

##Create  a type to an index or add a properties to a type

Example:


PUT Index_name 
{
  "mappings": {
    "New_type": {
      "properties": {
        "p1": {
          "type": "text"
        }
      }
    }
  }
}


PUT Index_name/_mapping/type_name1
{
  "properties": {
    "p1": {
      "type": "text"
    }
  }
}

PUT index_name/_mapping/type_name2
{
  "properties": {
    "p3": {
      "type": "text"
    }
  }
}

##Query search 

Example:

POST /index_name/type_name/_search
{
     "query": {
        "query_string": {
           "default_field": "post_title",
           "query": "test"
        }
    }
}

POST /index_name/type_name/_search
{
    "query": {
        "match": {
           "field_name": "lorem ipseum"
        }
    }
}
