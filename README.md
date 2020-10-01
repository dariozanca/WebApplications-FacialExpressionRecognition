# WebApplications-FacialExpressionRecognition

This web application allows to remotely perform a human facial expression recognition test.

The test is divided into two phases:
- In the first phase the subject is asked to recognize the emotions corresponding to "emoticons" (drawings): they must click on the button corresponding to the emotion they believe to be correct. The buttons represent six different expressions are positioned ath the bottom the emoticon.
- In the second phase the previous test is repeated, this time with real human facial expressions (not emoticons). In this case, the expressions are "dynamic": the face takes a few seconds to switch from neutral to the final expression.

The test results are saved in CSV format in a folder on the server. The user who performs the test is allowed to download results to their PC at the end of the test.
