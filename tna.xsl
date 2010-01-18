<?xml version="1.0" encoding="ISO-8859-1" ?> 
  <xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
  	<xsl:apply-templates select="info" /> 
  </xsl:template>
  <xsl:template match="img">
  	<img>
  		<xsl:attribute name="width">75px</xsl:attribute> 
		<xsl:attribute name="height">100px</xsl:attribute> 
  		<xsl:attribute name="src">
   			<xsl:value-of select="." /> 
  		</xsl:attribute>
  	</img>
  	<xsl:text> </xsl:text> 
  </xsl:template>
  <xsl:template match="info">
	<table width="200" cellpadding="0" cellspacing="0">
		<tr>
		<td style="font-size:12px;text-align:left;">
	  		<xsl:value-of select="FullName" /><br />
			<xsl:value-of select="address" />
		</td>
		<td align="right" valign="middle">
			<xsl:apply-templates select="img" /> 
		</td>
		</tr>
	</table>
</xsl:template>
</xsl:stylesheet>