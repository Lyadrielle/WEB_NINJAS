import axios from 'axios'

// HELPERS
function createError({ message, ...options }) {
  let error = new Error(message)
  return Object.entries(options).reduce((acc, [key, value]) => {
    acc[key] = value
    return acc
  }, error)
}

const statusMap = {
  internalServerError: { code: 500, defaultMessage: 'Internal server error' },
  badRequest: { code: 400, defaultMessage: 'Bad request' },
  authenticationRequired: { code: 401, defaultMessage: 'Authentication required' },
  forbidden: { code: 403, defaultMessage: 'Access denied' },
}

function createHttpError(status, message) {
  const numStatus = Number(status)
  if (!numStatus) {
    const currentStatusData = statusMap[status]
    if (!message) {
      return createError({
        message: currentStatusData.defaultMessage,
        status: currentStatusData.code,
      })
    }
    return createError({
      message,
      status: currentStatusData.code,
    })
  }
  return createError({
    message,
    status,
  })
}

// API CALLS
async function signin(user, password) {
  if (!user || !signin) {
     new Error()
  }
}