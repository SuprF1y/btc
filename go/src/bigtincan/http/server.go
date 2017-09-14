/**
 * HTTP Restful server
 * Author: willem.j.homan@gmail.com
 * Date: 13/09/17
 * Time: 12:59 PM
 */
package http

import (
	"log"
	"net/http"
	"github.com/gorilla/mux"
	"strconv"
	"bigtincan/http/widgetService"
)

/**
 * REST server
 */

func Serve() {
	// get the server port
	port := GetPort()

	// setup the routes
	router := mux.NewRouter()
	widgetService.SetupRoutes(router)

	// listen for connections
	log.Fatal(http.ListenAndServe(":"+strconv.Itoa(port), router))
}
