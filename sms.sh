#!/bin/bash
 
USERNAME=gigared
PASSWORD=4351828
FROM=0000
TO=0835431474
MESSAGE=Test
curl -q "http://www.thsms.com/api/rest?method=send&username=$USERNAME&password=$PASSWORD&from=$FROM&to=$TO&message=$MESSAGE"
