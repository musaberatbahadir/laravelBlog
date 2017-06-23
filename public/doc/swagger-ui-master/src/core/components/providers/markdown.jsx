import React, { PropTypes } from "react"
import Remarkable from "react-remarkable"
import sanitize from "sanitize-html"

const sanitizeOptions = {
  textFilter: function(text) {
    return text
      .replace(/&quot;/g, "\"")
  }
}

function Markdown({ source }) {
  const sanitized = sanitize(source, sanitizeOptions)

  // sometimes the sanitizer returns "undefined" as a string
  if(!source || !sanitized || sanitized === "undefined") {
    return null
  }

  return <Remarkable
    options={{html: true, typographer: true, linkify: true, linkTarget: "_blank"}}
    source={sanitized}
    ></Remarkable>
}

Markdown.propTypes = {
  source: PropTypes.string.isRequired
}

export default Markdown
