/**
 * entry point for Widget REST service
 * Author: willem.j.homan@gmail.com
 * Date: 13/09/17
 * Time: 12:59 PM
 */
package main

import (
	"github.com/joho/godotenv"
	"bigtincan/http"
)

func main() {
	// read the env config vars from .env if they exist
	godotenv.Load()
	// start the http server
	http.Serve()
}

